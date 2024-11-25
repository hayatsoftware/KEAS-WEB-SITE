<?php

namespace App\DataTable;

use Carbon\Carbon;
use Html;
use Mediapress\DataTable\DataTableInterface;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\Sitemap;
use Yajra\DataTables\Facades\DataTables;
use Yajra\Datatables\Html\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

const SITEMAP_ID = 'sitemap_id';

class Weights implements DataTableInterface
{

    const DATA = 'data';
    const NAME = 'name';
    const TITLE = 'title';
    const FOOTER = 'footer';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const SITEMAP_ID = 'sitemap_id';
    private $array =
        [
            0 => 'warning',
            1 => 'primary',
            2 => 'warning',
            3 => 'warning',
        ];

    public function columns(Builder $builder)
    {
        $request = request();
        return $builder->parameters([
            "lengthMenu" => [25, 50, 75, 100],
            "pageLength" => session('pageLength.sitemaps.' . $request->segments()[count($request->segments()) - 1], 25)
        ])->columns([
            [
                self::DATA => 'order',
                self::NAME => 'order',
                self::TITLE => trans("MPCorePanel::general.order"),
                self::FOOTER => trans("MPCorePanel::general.order")
            ],
            [
                self::DATA => 'status',
                self::NAME => 'status',
                self::TITLE => '<i class="fa fa-info-circle"></i>',//trans("MPCorePanel::general.status"),
                self::FOOTER => '<i class="fa fa-info-circle"></i>',//trans("MPCorePanel::general.status"),
            ],
            [
                self::DATA => 'id',
                self::NAME => 'id',
                self::TITLE => 'ID',
                self::FOOTER => 'ID',
            ],
            [
                self::DATA => 'cvar_1',
                self::NAME => 'cvar_1',
                self::TITLE => 'Weight',
                self::FOOTER => 'Weight'
            ]


        ])->addAction([self::TITLE => trans("MPCorePanel::general.actions")]);
    }

    public function ajax($website_id, Sitemap $sitemap, $parameter = null)
    {
        $request = request();

        $url = parse_url($request->header('referer'));
        if (isset($url['query'])) {
            parse_str('&' . $url['query'], $array);
        }



        $pages = Page::select("pages.id", "pages.order", "pages.status", "pages.password", "pages.allowed_role_id",
            self::CREATED_AT, self::UPDATED_AT, "pages.cvar_1")
            ->where('pages.status', '!=', 3)
            ->where(self::SITEMAP_ID, $sitemap->id)
            ->distinct('pages.id');

        session(['pageLength.sitemaps.' . $request->segments()[count($request->segments()) - 1] => $request->get('length')]);

        return Datatables::eloquent($pages)
            ->editColumn('status', function ($page) {
                $status_class = null;
                $statusses = [
                    0 => "passive",
                    1 => "active",
                    2 => "draft",
                    3 => "predraft",
                    4 => "pending",
                    5 => "postdate",
                ];
                switch ($page->status) {
                    case 0:
                        //status PASSIVE
                        $status_class = "danger";
                        break;
                    case 1:
                        //status ACTIVE
                        $status_class = "active";
                        break;
                    case 2:
                        //status DRAFT
                        $status_class = "passive";
                        break;
                    case 3:
                        //status PREDRAFT
                        $status_class = "passive";
                        break;
                    case 4:
                        //status PENDING
                        $status_class = "pending";
                        break;
                    case 5:
                        //status POSTDATE
                        $status_class = "pending";
                        break;
                }

                $status_circle = $status_class ? '<i class="status_circle mr-1 ' . $status_class . '" title="' . (isset($statusses[$page->status]) ? trans("ContentPanel::general.status_title." . ($statusses[$page->status])) : "") . '"></i>' : "";
                $protected_content = $page->password || $page->allowed_role_id ? '<i class="fa fa-lock" title="' . trans("ContentPanel::general.protected_content") . '"></i>' : "";
                $postdate_publish = dateFilled($page,
                    "published_at") ? '<i class="fa fa-calendar" title="' . trans("ContentPanel::general.postdate_publish") . " (" . $page->published_at . ")" . '"></i>' : "";


                return $status_circle . $protected_content . $postdate_publish;
            })
            ->editColumn('id', function ($page)  {
                return $page->id;
            })
            ->editColumn('cvar_1', function ($page) {
                return $page->cvar_1;
            })
            ->addColumn('action', function ($page) use ($sitemap) {

                $route_params = [SITEMAP_ID => $sitemap->id, 'id' => $page->id];
                if (request()->has('page_id') && request()->page_id) {
                    $route_params["page_id"] = request()->page_id;
                }

                $children = $sitemap->children()->with([
                    'detail' => function ($q) {
                        $q->select('sitemap_id', 'name');
                    }
                ])->get(['id'])->pluck('detail.name', 'id')->toArray();

                $actions = '<a href="' . route('Content.pages.edit',
                        $route_params) . '" title="' . trans("MPCorePanel::general.edit") . '"><span class="fa fa-pen"></span></a>';
                $i = 0;
                foreach ($children as $sitemap_id => $child) {

                    $actions .= '<a class="btn btn-sm btn-' . $this->array[$i] . '" style="margin:0 2px" href="' . route('Content.pages.index', [
                            'sitemap_id' => $sitemap_id, 'page_id' => $page->id
                        ]) . '" title="' . $child . '">' . $child . '</a>';
                    $i++;
                }
                return $actions .= '<a href="' . route('Content.pages.delete',
                        $route_params) . '" class="needs-confirmation" title="' . trans("MPCorePanel::general.delete") . '" data-dialog-text="' . trans("MPCorePanel::general.action_cannot_undone") . '" data-dialog-cancellable="1" data-dialog-type="warning" ><span class="fa fa-trash"></span></a>';
            })->rawColumns([
                "status", 'id', "cvar_1", "action"
            ])
            ->setRowId('tbl-{{$id}}')->make(true);

    }
}
