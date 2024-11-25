<?php

use Illuminate\Support\Facades\Cache;

const PRODUCT_ST_ID = 3;
const BRANDS_ST_ID = 4;
const DECORATIVE_PANEL_DECORS_ST_ID = 5;
const DECORATIVE_PANEL_EXTRA_FEATURES_ST_ID = 6;
const DECORATIVE_PANEL_SURFACE_ST_ID = 7;
const DECORATIVE_PANEL_FEATURES_ST_ID = 8;
const DECORATIVE_PANEL_CERTIFICATE_ST_ID = 9;
const PANEL_SURFACES_ST_ID = 13;
const PANEL_DECORS_ST_ID = 10;
const PANEL_LOCKS_ST_ID = 12;
const PANEL_BEVELS_ST_ID = 11;
const DOOR_PANEL_CERTIFICATE_ST_ID = 14;
const DOOR_PANEL_EXTRA_FEATURES_ST_ID = 15;
const DOOR_PANEL_FEATURES_ST_ID = 16;
const DOOR_PANEL_SURFACES_ST_ID = 17;
const DOOR_PANEL_TEXTURES_ST_ID = 18;
const WORKTOP_SURFACES_ST_ID = 23;
const WORKTOP_DECORS_ST_ID = 19;
const WORKTOP_EXTRA_FEATURES_ST_ID = 20;
const WORKTOP_FEATURES_ST_ID = 21;
const WORKTOP_CERTIFICATES_ST_ID = 22;
const MDF_EXTRA_FEATURES_ST_ID = 26;
const MDF_SUB_PAGES_ST_ID = 27;
const CLASSIFICATION_ST_ID = 28;
const CATEGORY_FEATURES_ST_ID = 29;
const DOCUMENT_ST_ID = 30;
const PARKE_FEATURES_ST_ID = 31;
const PARKE_CERTIFICATE_ST_ID = 32;
const SALE_POINTS_CATEGORY_ST_ID = 35;
const SALE_POINTS_DEALER_TYPES_ST_ID = 36;
const SALE_POINTS_ST_ID = 37;
const SALE_AGENTS_ST_ID = 38;
const BLOG_ST_ID = 40;
const HOMEPAGE_SLIDER_ST_ID = 41;
const HOMEPAGE_APP_SLIDER_ST_ID = 42;
const HOMEPAGE_BOXES_ST_ID = 43;
const BRAND_DOCUMENT_ST_ID = 48;
const SOCIAL_MEDIA_ST_ID = 49;
const GENERAL_APPROACH_ST_ID = 50;
const KVKK_ST_ID = 51;
const KEAS_CONCEPT_ST_ID = 52;
const EVENTS_ST_ID = 53;
const SUSTAINABILITY_ST_ID = 54;
const INNOVATION_ST_ID = 55;
const QUALITY_ST_ID = 57;
const QUALITY_SUB_PAGE_ST_ID = 58;
const PRODUCT_QUALITY_DOCUMENTS_ST_ID = 59;
const QUALITY_STATEMENTS_DOCUMENTS_ST_ID = 60;
const WARRANTY_DOCUMENTS_ST_ID = 61;
const OUR_POLICIES_ST_ID = 62;
const OUR_DOCUMENTS_ST_ID = 63;
const SEARCH_ST_ID = 66;
const YOU_DESIGN_ST_ID = 68;
const YOU_DESIGN_SUB_PAGES_ST_ID = 69;
const CONTACT_ST_ID = 74;
const CRM_SUBJECT_ST_ID = 75;
const CONTACT_OFFICES_ST_ID = 76;
const CONTACT_DOMESTIC_OFFICES_ST_ID = 77;
const CONTACT_ABROAD_OFFICES_ST_ID = 78;
const LOGIN_ST_ID = 80;
const REGISTER_ST_ID = 81;
const CRM_JOBS_ST_ID = 82;
const MY_ACCOUNT_ST_ID = 83;
const USER_ACTIVATION_ST_ID = 84;
const ACCOUNT_INFORMATION_ST_ID = 85;
const FORGOT_MY_PASSWORD = 86;
const RESET_PASSWORD_ST_ID = 87;
const PARKE_CLASSES_ST_ID = 89;
const CRM_EBULTEN_BRANDS_ST_ID = 91;
const CRM_PREFERRED_PRODUCTS_ST_ID = 90;
const KEAS_CLUB_ST_ID = 92;
const USER_CATALOGUE_ST_ID = 93;
const KEAS_CRM_CATALOGUE_ST_ID = 94;
const CATEGORY_CERTIFICATE_ST_ID = 95;

const WATER_RESISTANCE_ST_ID = 5082;

function setCountryForCrm($country){
    $country_text = "";
    switch ($country) {
        case 1:
        case 7:
            $country_text = 'Türkiye';
            break;
        case 2:
            $country_text = 'Bulgaristan';
            break;
        case 3:
            $country_text = 'Romanya';
            break;
        case 4:
        case 5:
            $country_text = 'Rusya';
            break;
        case 6:
            $country_text = 'İtalya';
            break;
    }
    return $country_text;
}

function setLanguageForCrm($language)
{
    $language_text = "";
    switch($language){
        case 760:
            $language_text = "TR";
            break;
        case 626:
            $language_text = "FR";
            break;
        case 620:
            $language_text = "ES";
            break;
        case 616:
            $language_text = "EN";
            break;
        case 790:
            $language_text = "BG";
            break;
        case 724:
            $language_text = "RO";
            break;
        case 795:
            $language_text = "RU";
            break;
        case 653:
            $language_text = "IT";
            break;
    }
    return $language_text;
}

function user_modify_panelmenu($menu)
{

    $menu['header_menu']['content']['cols']['sitemaps']['rows'][] = [
        'title' => 'Sales',
        'type' => 'submenu',
        'url' => '#',
        'children' => [
            0 => [
                'title' => 'Dealers',
                'type' => 'submenu',
                'url' => url('/mp-admin/SalePoints'),
            ],
            1 => [
                'title' => 'Sale Agents',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/38')
            ],
            2 => [
                'title' => 'Dealer Category',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/35')
            ],
            3 => [
                'title' => 'Dealer Types',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/36')
            ]
        ]
    ];
    $menu['header_menu']['content']['cols']['show_case']['name'] = 'Products';
    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => ' MDF-Particle-Board',
        'type' => 'submenu',
        'url' => '#',
        'children' => [
            0 => [
                'title' => 'Products',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/3?category=2')
            ],
            1 => [
                'title' => 'Extra Features',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/26')
            ],
            2 => [
                'title' => 'Mdf Yonga Classification',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/28')
            ]
        ]
    ];

    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => 'Decorative Panel',
        'type' => 'submenu',
        'url' => '#',
        'children' => [
            0 => [
                'title' => 'Products',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/3?category=5')
            ],
            1 => [
                'title' => 'Decors',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/5')
            ],
            2 => [
                'title' => 'Extra Features',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/6')
            ],
            3 => [
                'title' => 'Surfaces',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/7')
            ],
            4 => [
                'title' => 'Features',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/8')
            ],
            5 => [
                'title' => 'Certificates',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/9')
            ]
        ]
    ];

    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => 'Door Panel',
        'type' => 'submenu',
        'url' => '#',
        'children' => [
            0 => [
                'title' => 'Products',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/3?category=11')
            ],
            1 => [
                'title' => 'Textures',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/18')
            ],
            2 => [
                'title' => 'Extra Features',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/15')
            ],
            3 => [
                'title' => 'Surfaces',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/17')
            ],
            4 => [
                'title' => 'Features',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/16')
            ],
            5 => [
                'title' => 'Certificates',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/14')
            ]
        ]
    ];

    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => 'Laminate Flooring',
        'type' => 'submenu',
        'url' => '#',
        'children' => [
            1 => [
                'title' => 'Products',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/3?category=15')
            ],
            2 => [
                'title' => 'Decors',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/10')
            ],
            3 => [
                'title' => 'Bevels',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/11')
            ],
            4 => [
                'title' => 'Locks',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/12')
            ],
            5 => [
                'title' => 'Surfaces',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/13')
            ],
            6 => [
                'title' => 'Features',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/31')
            ],
            7 => [
                'title' => 'Certificates',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/32')
            ],
            8 => [
                'title' => 'Weights',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/33')
            ],
            9 => [
                'title' => 'Areas',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/34')
            ],
            10 => [
                'title' => 'Classes',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/89')
            ],
            11 => [
                'title' => 'Water Resistance',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/5082')
            ]
        ]
    ];

    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => 'Worktop',
        'type' => 'submenu',
        'url' => '#',
        'children' => [
            0 => [
                'title' => 'Products',
                'type' => 'submenu',
                'url' =>  url('/mp-admin/Content/Pages/3?category=14'),
            ],
            1 => [
                'title' => 'Decors',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/19')
            ],
            2 => [
                'title' => 'Extra Features',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/20')
            ],
            3 => [
                'title' => 'Features',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/21')
            ],
            4 => [
                'title' => 'Certificates',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/22')
            ],
            5 => [
                'title' => 'Surfaces',
                'type' => 'submenu',
                'url' => url('/mp-admin/Content/Pages/23')
            ]
        ]
    ];

    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => 'Category Features',
        'type' => 'submenu',
        'url' => url('/mp-admin/Content/Pages/29')
    ];
    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => 'Category Certificates',
        'type' => 'submenu',
        'url' => url('/mp-admin/Content/Pages/95')
    ];
    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => 'Documents',
        'type' => 'submenu',
        'url' => url('/mp-admin/Content/Pages/30')
    ];

    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => 'Dimensions',
        'type' => 'submenu',
        'url' => url('/mp-admin/Content/Pages/24')
    ];

    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => 'Thicknesses',
        'type' => 'submenu',
        'url' => url('/mp-admin/Content/Pages/25')
    ];

    $menu['header_menu']['content']['cols']['show_case']['rows'][] = [
        'title' => 'Brands',
        'type' => 'submenu',
        'url' => url('/mp-admin/Content/Pages/4')
    ];



    if( !\Str::contains(auth()->user()->email, 'mediaclick.com.tr') ){
        $moduller = $menu['header_menu']['content']['cols']['modules']['rows'];
        unset($menu['header_menu']['content']['cols']['modules']['rows']);

        foreach( $moduller as $key => $row ){

            if( $row['url'] == url('/mp-admin/CommentStructure') || $row['url'] == url('/mp-admin/Content/Sliders') || $row['url'] == url('/mp-admin/Content/SocialMedia') ){

            }else{
                $menu['header_menu']['content']['cols']['modules']['rows'][$key] = $row;
            }
        }
        unset($menu['header_menu']['forms']);
        unset($menu['header_menu']['settings']['cols']['structure']);
        unset($menu['header_menu']['settings']['cols']['system']);
        unset($menu['header_menu']['settings']['cols']['editor']);
        $seomenus = $menu['header_menu']['settings']['cols']['seo']['rows'];
        unset($menu['header_menu']['settings']['cols']['seo']['rows']);
        foreach( $seomenus as $key => $row ){

            if( $row['url'] == url('/mp-admin/GoogleTagManager')){

            }else{
                $menu['header_menu']['settings']['cols']['seo']['rows'][$key] = $row;
            }
        }
        $menu['header_menu']['settings']['cols']['seo']['rows'][] = [
            'title' => 'General Settings',
            'type' => 'submenu',
            'url' => url('/mp-admin/Settings')
        ];
    }
    $menu['header_menu']['content']['cols']['modules']['rows'][] = [
        'title' => 'Social Media',
        'type' => 'submenu',
        'url' => url('/mp-admin/Content/Pages/49')
    ];
    $menu['header_menu']['content']['cols']['modules']['rows'][] = [
        'title' => 'Crm Tracker',
        'type' => 'submenu',
        'url' => url('/mp-admin/CrmTracker')
    ];
    $menu['header_menu']['content']['cols']['modules']['rows'][] = [
        'title' => 'City Management',
        'type' => 'submenu',
        'url' => url('/mp-admin/Cities')
    ];
    return $menu;
}

function filesize_text($size)
{
    $sizes = ['B', 'KB', 'MB', 'GB'];
    $count=0;
    if ($size < 1024) {
        return $size . " " . $sizes[$count];
    } else{
        while ($size>1024){
            $size=round($size/1024,2);
            $count++;
        }
        return $size . " " . $sizes[$count];
    }
}

function get_pages($mediapress, $ids){
    $pages = \DB::table('pages')
        ->select('pages.id', 'pages.cint_1', 'page_details.name', 'page_details.id as page_detail_id', 'cover_image.mfile_id as cover_image_id')
        ->join('page_details', function($join)use($mediapress){
            $join->on('page_details.page_id', '=', 'pages.id')
                ->where(function($query){
                    return $query->where('page_details.name', '!=', NULL)
                        ->where('page_details.name', '!=', '-');
                })
                ->where('page_details.language_id', $mediapress->activeLanguage->id)
                ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                ->where('page_details.deleted_at', NULL);
        })
        ->leftJoin('mfile_general as cover_image', function($join){
            $join->on('cover_image.model_id', '=', 'pages.id')->where('cover_image.file_key', 'cover')->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Page');
        })
        ->where('pages.status', 1)
        ->whereIn('pages.id', $ids)
        ->get();
    return $pages;
}

function get_pages_api($cg, $lg, $ids){
    $pages = \DB::table('pages')
        ->select('pages.id', 'page_details.name', 'page_details.id as page_detail_id', 'cover_image.mfile_id as cover_image_id')
        ->join('page_details', function($join)use($cg, $lg){
            $join->on('page_details.page_id', '=', 'pages.id')
                ->where(function($query){
                    return $query->where('page_details.name', '!=', NULL)
                        ->where('page_details.name', '!=', '-');
                })
                ->where('page_details.language_id', $lg->id)
                ->where('page_details.country_group_id', $cg->id)
                ->where('page_details.deleted_at', NULL);
        })
        ->leftJoin('mfile_general as cover_image', function($join){
            $join->on('cover_image.model_id', '=', 'pages.id')->where('cover_image.file_key', 'cover')->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Page');
        })
        ->where('pages.status', 1)
        ->whereIn('pages.id', $ids)
        ->get();
    return $pages;
}

function get_page_api($cg, $lg, $id){
    $pages = \DB::table('pages')
        ->select('pages.id', 'page_details.name', 'page_details.id as page_detail_id', 'cover_image.mfile_id as cover_image_id')
        ->join('page_details', function($join)use($cg, $lg){
            $join->on('page_details.page_id', '=', 'pages.id')
                ->where(function($query){
                    return $query->where('page_details.name', '!=', NULL)
                        ->where('page_details.name', '!=', '-');
                })
                ->where('page_details.language_id', $lg->id)
                ->where('page_details.country_group_id', $cg->id)
                ->where('page_details.deleted_at', NULL);
        })
        ->leftJoin('mfile_general as cover_image', function($join){
            $join->on('cover_image.model_id', '=', 'pages.id')->where('cover_image.file_key', 'cover')->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Page');
        })
        ->where('pages.status', 1)
        ->where('pages.id', $id)
        ->first();
    return $pages;
}

function get_pages_api_cint_one($cg, $lg, $ids){
    $pages = \DB::table('pages')
        ->select('pages.id', 'pages.cvar_1 as name')
        ->whereNull('pages.deleted_at')
        ->where('pages.status', 1)
        ->whereIn('pages.id', $ids)
        ->orderBy('order')
        ->get();
    return $pages;
}

function get_pagesby_en($ids){
    $pages = \DB::table('pages')
        ->select('page_details.name')
        ->join('page_details', function($join){
            $join->on('page_details.page_id', '=', 'pages.id')
                ->where(function($query){
                    return $query->where('page_details.name', '!=', NULL)
                        ->where('page_details.name', '!=', '-');
                })
                ->where('page_details.language_id', 616)
                ->where('page_details.deleted_at', NULL);
        })
        ->where('pages.status', 1)
        ->whereIn('pages.id', $ids)
        ->groupBy('page_details.language_id')
        ->get()
        ->pluck('name');
    return $pages;
}

function get_brand_pages($mediapress, $id){
    $pages = \DB::table('pages')
        ->select('pages.id', 'pages.cint_1', 'pages.cint_2', 'page_details.name', 'page_details.id as page_detail_id', 'cover_image.mfile_id as cover_image_id')
        ->join('page_details', function($join)use($mediapress){
            $join->on('page_details.page_id', '=', 'pages.id')
                ->where(function($query){
                    return $query->where('page_details.name', '!=', NULL)
                        ->where('page_details.name', '!=', '-');
                })
                ->where('page_details.language_id', $mediapress->activeLanguage->id)
                ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                ->where('page_details.deleted_at', NULL);
        })
        ->leftJoin('mfile_general as cover_image', function($join){
            $join->on('cover_image.model_id', '=', 'pages.id')->where('cover_image.file_key', 'cover')->where('cover_image.model_type', 'Mediapress\Modules\Content\Models\Page');
        })
        ->where('pages.status', 1)
        ->where('pages.cint_1', $id)
        ->where('sitemap_id', BRANDS_ST_ID)
        ->get();
    return $pages;
}

function get_brand_page_api($cg, $lg, $id){
    $page = \DB::table('pages')
        ->select('pages.id', 'pages.cint_2', 'page_details.name', 'page_details.detail', 'page_detail_extras_usage_area.value as usage_area')
        ->join('page_details', function($join)use($cg, $lg){
            $join->on('page_details.page_id', '=', 'pages.id')
                ->where(function($query){
                    return $query->where('page_details.name', '!=', NULL)
                        ->where('page_details.name', '!=', '-');
                })
                ->where('page_details.language_id', $lg->id)
                ->where('page_details.country_group_id', $cg->id)
                ->where('page_details.deleted_at', NULL);
        })
        ->leftJoin('page_detail_extras as page_detail_extras_usage_area', function($join){
            $join->on('page_detail_extras_usage_area.page_detail_id', '=', 'page_details.id')
                ->where('page_detail_extras_usage_area.key', 'usages');
        })
        ->where('pages.status', 1)
        ->where('pages.cint_1', $id)
        ->where('sitemap_id', BRANDS_ST_ID)
        ->first();
    return $page;
}

function get_category_of_page($id,$cg,$lg){
    $category = \DB::table('categories')
        ->select(
            'categories.id',
            'categories.category_id',
            'category_details.name',
            'category_details.detail',
            'category_detail_extras_usage_area.value as usage_area',
            'category_detail_extras_three_d.value as three_d',
            'category_detail_extras_virtual_room.value as virtual_room',
            'category_detail_extras_see_in_room.value as see_in_room'
        )
        ->join('category_details', function($join)use($cg, $lg){
            $join->on('category_details.category_id', '=', 'categories.id')
                ->where(function($query){
                    return $query->where('category_details.name', '<>', "")
                        ->where('category_details.name', '!=', '-');
                })
                ->where('category_details.language_id', $lg->id)
                ->where('category_details.country_group_id', $cg->id)
                ->where('category_details.deleted_at', NULL);
        })
        ->leftJoin('category_detail_extras as category_detail_extras_usage_area', function($join){
            $join->on('category_detail_extras_usage_area.category_detail_id', '=', 'category_details.id')
                ->where('category_detail_extras_usage_area.key', 'usages');
        })
        ->leftJoin('category_detail_extras as category_detail_extras_three_d', function($join){
            $join->on('category_detail_extras_three_d.category_detail_id', '=', 'category_details.id')
                ->where('category_detail_extras_three_d.key', 'threed');
        })
        ->leftJoin('category_detail_extras as category_detail_extras_virtual_room', function($join){
            $join->on('category_detail_extras_virtual_room.category_detail_id', '=', 'category_details.id')
                ->where('category_detail_extras_virtual_room.key', 'virtual_room');
        })
        ->leftJoin('category_detail_extras as category_detail_extras_see_in_room', function($join){
            $join->on('category_detail_extras_see_in_room.category_detail_id', '=', 'category_details.id')
                ->where('category_detail_extras_see_in_room.key', 'see_in_room');
        })
        ->where('categories.status', 1)
        ->where('categories.id', $id)
        ->first();
    return $category;
}

function get_image($id){
    $mFiles = \DB::table('mfiles')->where('id', $id)->first();
    $monthPath = \DB::table('mfolders')->where('id', $mFiles->mfolder_id)->first();
    $yearPath = \DB::table('mfolders')->where('id', $monthPath->mfolder_id)->first();
    return asset('uploads/'.$yearPath->path.'/'.$monthPath->path.'/'.$mFiles->filename.'.'.$mFiles->extension);
}

function get_image_path($id){
    $mFiles = \DB::table('mfiles')->where('id', $id)->first();
    $monthPath = \DB::table('mfolders')->where('id', $mFiles->mfolder_id)->first();
    $yearPath = \DB::table('mfolders')->where('id', $monthPath->mfolder_id)->first();
    return 'uploads/'.$yearPath->path.'/'.$monthPath->path.'/'.$mFiles->filename.'.'.$mFiles->extension;
}

if( !function_exists('do_shortcode') ){
    function do_shortcode($template){
        $template = str_replace('<br />', '', $template);
        $regex = "/\[(.*?)\]/";
        preg_match_all($regex, $template, $matches);
        for($i = 0; $i < count($matches[1]); $i++){
            $template = $template;
            if( $matches[1][$i] == "resource-usage-page" ){
                $resources = Page::where('sitemap_id', RESOURCE_USAGE_ST_ID)->where('status', 1)->orderBy('order')->get();
                $render = view('web.pages.resourceusage.page', compact('resources'))->render();
                $template = str_replace($matches[0][$i], $render, $template);
            }
            if( $matches[1][$i] == "reports" ){
                $reports = Page::where('sitemap_id', REPORTS_ST_ID)->where('status', 1)->orderBy('order')->get();
                $render = view('web.pages.reports.page', compact('reports'))->render();
                $template = str_replace($matches[0][$i], $render, $template);
            }
            $output = '<'.$matches[1][$i].'>';
            $template = str_replace($matches[0][$i], $output, $template);
        }
        return $template;
    }
}

if(!function_exists('get_countries')){
    function get_countries(): array
    {
        return collect(json_decode(file_get_contents(public_path('countries.json'))), TRUE)->sortBy('tr')->toArray();
    }
}

if(!function_exists('setMatteGloss')){
    function setMatteGloss($value){
        $matteGloss = "";
        switch($value){
            case 1:
                $matteGloss = 'Matte';
                break;
            case 2:
                $matteGloss = 'Gloss';
        }
        return $matteGloss;
    }
}

if(!function_exists('get_category_by_id')){
    function get_category_by_id($cg,$lg,$category_id){
        return Cache::remember('get_category_by_id'.$cg.'_'.$lg.'_'.$category_id, 7*24*60*60, function()use($cg,$lg,$category_id){
            return \DB::table('categories')
                ->select(
                    'categories.id',
                    'category_details.name'
                )
                ->join('category_details', function($join)use($cg,$lg){
                    $join->on('category_details.category_id', '=', 'categories.id')
                        ->where('category_details.name', '!=', NULL)
                        ->where('category_details.language_id', $lg)
                        ->where('category_details.country_group_id', $cg)
                        ->where('category_details.deleted_at', NULL);
                })
                ->where('categories.sitemap_id', PRODUCT_ST_ID)
                ->where('categories.id', $category_id)
                ->where('categories.status', 1)
                ->first();
        });

    }
}

if(!function_exists('convert_images_from_content')){
    function convert_images_from_content($content){
        $doc = new DOMDocument();
        $doc->encoding = 'utf-8';
        $doc->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $content);
        $image_tags = $doc->getElementsByTagName('img');
        $iframe_tags = $doc->GetElementsByTagName('iframe');
        foreach ($image_tags as $tag) {
            $old_src = $tag->getAttribute('src');
            $new_src_url = asset($old_src);
            $tag->setAttribute('src', $new_src_url);
        }
        foreach($iframe_tags as $iframe_tag) {
            $prent = $iframe_tag->parentNode;
            $prent->replaceChild($doc->createTextNode($iframe_tag->nodeValue), $iframe_tag);

        }
        return preg_replace('~<(?:!DOCTYPE|/?(?:html|body|meta|head))[^>]*>\s*~i', '', $doc->saveHTML());
    }
}

if(!function_exists('getPagesDetailsIds')){
    function getPagesDetailsIds($current_category,$cg,$lg){
        return \DB::table('pages')
            ->select(
                'pages.id',
                'page_details.id as page_detail_id',
                'categories.id as category_id'
            )
            ->join('page_details', function($join)use($cg,$lg){
                $join->on('page_details.page_id', '=', 'pages.id')
                    ->where('page_details.name', '<>', "")
                    ->where('page_details.language_id', $lg->id)
                    ->where('page_details.country_group_id', $cg->id)
                    ->where('page_details.deleted_at', NULL);
            })
            ->join('category_page', function($join){
                $join->on('category_page.page_id', '=', 'pages.id');
            })
            ->join('categories', function($join)use($current_category){
                if( $current_category == 5 || $current_category == 11 || $current_category == 16 || $current_category == 2){
                    $join->on('categories.id', '=' ,'category_page.category_id')
                        ->where('categories.category_id', $current_category);
                }else{
                    $join->on('categories.id', '=' ,'category_page.category_id')
                        ->where('categories.id', $current_category);
                }

            })
            ->where('pages.sitemap_id', PRODUCT_ST_ID)
            ->where('pages.status', 1)
            ->get()
            ->pluck('page_detail_id');
    }
}

if(!function_exists('getPagesIdsFilter')){
    function getPagesIdsFilter($category,$cg,$lg){
        return \DB::table('pages')
            ->select(
                'pages.id as page_id',
                'categories.id as category_id'
            )
            ->join('category_page', function($join){
                $join->on('category_page.page_id', '=', 'pages.id');
            })
            ->join('categories', function($join)use($category){
                if( $category->category_id == 15 ){
                    $join->on('categories.id', '=' ,'category_page.category_id')
                        ->where('categories.category_id', $category->id);
                }else{
                    $join->on('categories.id', '=' ,'category_page.category_id')
                        ->where('categories.id', $category->id);
                }

            })
            ->when($lg && $cg, function($query)use($lg, $cg){
                $query->join('page_details', function($join)use($lg, $cg){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where('page_details.language_id', $lg->id)
                        ->where('page_details.country_group_id', $cg->id)
                        ->whereNull('page_details.deleted_at')
                        ->where('page_details.name', '<>', '')
                        ->where('page_details.name', '!=', '-');
                });
            })
            ->where('pages.sitemap_id', PRODUCT_ST_ID)
            ->where('pages.status', 1)
            ->get()
            ->pluck('page_id');
    }
}





