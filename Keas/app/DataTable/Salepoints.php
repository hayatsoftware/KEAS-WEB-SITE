<?php

namespace App\DataTable;


use Carbon\Carbon;
use Html;
use Mediapress\DataTable\DataTableInterface;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\Sitemap;
use Mediapress\Modules\MPCore\Models\CountryGroupLanguage;
use Yajra\DataTables\Facades\DataTables;
use Yajra\Datatables\Html\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

const SITEMAP_ID = 'sitemap_id';

class Salepoints implements DataTableInterface
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
                self::DATA => 'native_name',
                self::NAME => 'native_name',
                self::TITLE => 'Name',
                self::FOOTER => 'Name'
            ],
            [
                self::DATA => 'native_city',
                self::NAME => 'native_city',
                self::TITLE => 'City',
                self::FOOTER => 'City'
            ],
            [
                self::DATA => 'native_address',
                self::NAME => 'native_address',
                self::TITLE => 'Address',
                self::FOOTER => 'Address'
            ],
            [
                self::DATA => 'country',
                self::NAME => 'country',
                self::TITLE => 'Country',
                self::FOOTER => 'Country'
            ],
            [
                self::DATA => 'zone_id',
                self::NAME => 'zone_id',
                self::TITLE => 'Zone',
                self::FOOTER => 'Zone'
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

        $pages = \DB::table('sale_points')
            ->select('sale_points.*', 'country_groups.list_title as country_name')
            ->join('country_groups',function($join){
                $join->on('country_groups.id', '=', 'sale_points.zone_id');
            })->when(auth()->user()->country_group, function($query){
                return $query->where('zone_id', auth()->user()->country_group);
            });

        $searchKey = $request->get('search')['value'] ?? "";
        if ($searchKey) {
            request()->merge([
                'search' => [
                    'value' => strto('lower', $searchKey),
                    'regex' => "false",
                ]
            ]);
        }

        session(['pageLength.sitemaps.' . $request->segments()[count($request->segments()) - 1] => $request->get('length')]);

        return Datatables::of($pages)
            ->editColumn('status', function ($page) {
                $status_class = null;
                $statusses = [
                    0 => "passive",
                    1 => "active",
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

                }

                $status_circle = $status_class ? '<i class="status_circle mr-1 ' . $status_class . '" title="' . (isset($statusses[$page->status]) ? trans("ContentPanel::general.status_title." . ($statusses[$page->status])) : "") . '"></i>' : "";

                return $status_circle;
            })
            ->editColumn('id', function ($page)  {
                return $page->id;
            })
            ->editColumn('native_name', function ($page) {
                return $page->native_name;
            })
            ->editColumn('native_city', function ($page) {
                return $page->native_city;
            })
            ->editColumn('native_address', function ($page) use ($sitemap) {
                return $page->native_address;
            })
            ->editColumn('country', function ($page) use ($sitemap) {
                $country = \DB::table('countries')->where('id', $page->country)->first();
                return $country ? $country->en : '';
            })
            ->editColumn('zone_id', function ($page) use ($sitemap) {
                return $page->country_name;
            })
            ->addColumn('action', function ($page) use ($sitemap) {
                $route_params = ['sale_point' => $page->id];
                $actions = '<a href="' . route('panel.sale_points.edit',
                        $route_params) . '" title="' . trans("MPCorePanel::general.edit") . '"><span class="fa fa-pen"></span></a>';
                $actions .= '<a href="' . route('panel.sale_points.delete',
                        $route_params) . '" class="needs-confirmation" title="' . trans("MPCorePanel::general.delete") . '" data-dialog-text="' . trans("MPCorePanel::general.action_cannot_undone") . '" data-dialog-cancellable="1" data-dialog-type="warning" ><span class="fa fa-trash"></span></a>';
                return $actions;
              })->rawColumns([
                "status", 'id', "action"
            ])
            ->setRowId('tbl-{{$id}}')->make(true);

    }
}
