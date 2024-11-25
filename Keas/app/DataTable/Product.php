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

class Product implements DataTableInterface
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
                self::DATA => 'detail.name',
                self::NAME => 'detail.name',
                self::TITLE => 'Product Name',
                self::FOOTER => 'Product Name'
            ],
            [
                self::DATA => 'cint_1',
                self::NAME => 'cint_1',
                self::TITLE => 'Brand',
                self::FOOTER => 'Brand'
            ],
            [
                self::DATA => 'cint_3',
                self::NAME => 'cint_3',
                self::TITLE => 'Decor Code',
                self::FOOTER => 'Decor Code'
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
        $category_id = $array['category'] ?? null;
        if ($category_id) {
            $pages = Page::select("pages.id", "pages.order", "pages.status", "pages.password", "pages.allowed_role_id",
                self::CREATED_AT, self::UPDATED_AT, "pages.cint_1", "pages.cint_2", "pages.cint_3", "pages.cint_4", "pages.cdec_2",
                "pages.cint_5")
                ->with([
                    "detail" => function ($query) {
                        $query->select("id", "language_id", "page_id", "name",)
                            ->when(auth()->user()->country_group, function($query){
                                $language = CountryGroupLanguage::where('country_group_id', auth()->user()->country_group)->where('default', 1)->first();
                                return $query->where('country_group_id', auth()->user()->country_group)->where('language_id', $language->language_id)->where('name', '!=', "");
                            });
                    }
                    , 'extras'])
                ->whereHas('categories', function ($q) use ($category_id) {
                    if( $category_id == 1 || $category_id == 15){
                        $category_data = [];
                        $categories = \DB::table('categories')->where('category_id', $category_id)->get()->pluck('id');
                        foreach( $categories as $category ){
                            if( $category == 14 ){
                                array_push($category_data, 14);
                            }else{
                                $child_categories = \DB::table('categories')->where('category_id', $category)->get()->pluck('id');
                                foreach($child_categories as $id){
                                    array_push($category_data, $id);
                                }
                            }
                        }
                        $q->whereIn('categories.id', $category_data);

                    }elseif( $category_id == 5 || $category_id == 11 || $category_id == 2 ){
                        $q->where('categories.category_id', $category_id);
                    }else{
                        $q->where('id', $category_id);
                    }

                })
                ->when(auth()->user()->country_group, function($query){
                    $language = CountryGroupLanguage::where('country_group_id', auth()->user()->country_group)->where('default', 1)->first();
                    return $query->whereHas('detail', function($q)use($language){
                        return $q->where('country_group_id', auth()->user()->country_group)
                            ->where('language_id', $language->language_id)
                            ->where('name', '!=', "");
                    });

                })
                ->where('pages.status', '!=', 3)
                ->where(self::SITEMAP_ID, $sitemap->id)
                ->distinct('pages.id');
        } else {
            $pages = Page::select("pages.id", "pages.order", "pages.status", "pages.password", "pages.allowed_role_id",
                self::CREATED_AT, self::UPDATED_AT, "pages.cint_1", "pages.cint_2", "pages.cint_3", "pages.cint_4", "pages.cdec_2",
                "pages.cint_5")
                ->with([
                    "detail" => function ($query) {
                        $query->select("id", "language_id", "page_id", "name")
                            ->when(auth()->user()->country_group, function($query){
                                $language = CountryGroupLanguage::where('country_group_id', auth()->user()->country_group)->where('default', 1)->first();
                                return $query->where('country_group_id', auth()->user()->country_group)->where('language_id', $language->language_id);
                            });
                    }
                    , 'extras'])
                ->when(auth()->user()->country_group, function($query){
                    $language = CountryGroupLanguage::where('country_group_id', auth()->user()->country_group)->where('default', 1)->first();
                    return $query->whereHas('detail', function($q)use($language){
                        return $q->where('country_group_id', auth()->user()->country_group)
                            ->where('language_id', $language->language_id)
                            ->where('name', '!=', "");
                    });

                })
                ->where('pages.status', '!=', 3)
                ->where(self::SITEMAP_ID, $sitemap->id)
                ->distinct('pages.id');
        }


        $page_id = $request->page_id;
        if ($page_id && is_numeric($page_id)) {
            $pages = $pages->where('page_id', $page_id);
        }

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
            ->editColumn('cint_1', function ($page) {
                $brand = \DB::table('pages')->select('pages.id', 'page_details.name as page_detail_name')
                    ->join('page_details', function($join){
                        $join->on('page_details.page_id', '=', 'pages.id')
                            ->where('page_details.language_id', 616)
                            ->where('page_details.deleted_at', NULL);
                    })
                    ->where('sitemap_id', BRANDS_ST_ID)
                    ->when(isset($page->categories[0]) && ($page->categories[0]->id == 5 || $page->categories[0]->category_id == 5), function($query)use($page){
                        return $query->where('pages.cint_1', $page->detail->brand);
                    })
                    ->when(isset($page->categories[0]) && ($page->categories[0]->id != 5 && $page->categories[0]->category_id != 5), function($query)use($page){
                        return $query->where('pages.cint_1', $page->cint_1);
                    })
                    ->first();
                if(isset($brand->page_detail_name)){
                    return $brand->page_detail_name;
                }else{
                    return 'Not exist';
                }

            })
            ->editColumn('detail.name', function ($page) use ($sitemap) {
                $route_params = [SITEMAP_ID => $sitemap->id, 'id' => $page->id];
                if (request()->has('page_id') && request()->page_id) {
                    $route_params["page_id"] = request()->page_id;
                }

                return '<a href="' . route('Content.pages.edit', $route_params) . '"><span class="listMiniText">' . Str::title($page->detail ? $page->detail->name : " << NO DETAIL OBJ. FOUND >> ") . '</span></a>';
            })
            ->addColumn('action', function ($page) use ($sitemap) {

                $route_params = [SITEMAP_ID => $sitemap->id, 'id' => $page->id];
                if (request()->has('page_id') && request()->page_id) {
                    $route_params["page_id"] = request()->page_id;
                }
                $actions = '<a href="' . route('Content.pages.edit',
                        $route_params) . '" title="' . trans("MPCorePanel::general.edit") . '"><span class="fa fa-pen"></span></a>';
                if(isset($page->categories[0]) && ($page->categories[0]->id == 2 || $page->categories[0]->id == 3 || $page->categories[0]->id == 4)){
                    $children = $sitemap->children()->with([
                        'detail' => function ($q) {
                            $q->select('sitemap_id', 'name');
                        }
                    ])->get(['id'])->pluck('detail.name', 'id')->toArray();


                    $i = 0;
                    foreach ($children as $sitemap_id => $child) {

                        $actions .= '<a class="btn btn-sm btn-' . $this->array[$i] . '" style="margin:0 2px" href="' . route('Content.pages.index', [
                                'sitemap_id' => $sitemap_id, 'page_id' => $page->id
                            ]) . '" title="' . $child . '">Models</a>';
                        $i++;
                    }
                }

                return $actions .= '<a href="' . route('Content.pages.delete',
                        $route_params) . '" class="needs-confirmation" title="' . trans("MPCorePanel::general.delete") . '" data-dialog-text="' . trans("MPCorePanel::general.action_cannot_undone") . '" data-dialog-cancellable="1" data-dialog-type="warning" ><span class="fa fa-trash"></span></a>';
            })->rawColumns([
                "status", 'id', "detail.name", "cdec_2", "cint_1", "cint_2", "cint_3", "cint_4", "cint_5", "action"
            ])
            ->setRowId('tbl-{{$id}}')->make(true);

    }
}
