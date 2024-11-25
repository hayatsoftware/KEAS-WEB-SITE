@php
    $countryGroup = $mediapress->activeCountryGroup;
    $languageMain = $mediapress->activeLanguage;
    $header_menu = Cache::remember('header_menu_'.$languageMain->code.'_'.$countryGroup->code, 7*24*60*60, function()use($mediapress){
        return $mediapress->menu('header-menu');
    });
    $top_menu = Cache::remember('top_menu_'.$languageMain->code.'_'.$countryGroup->code, 7*24*60*60, function()use($mediapress){
        return $mediapress->menu('top-menu');
    });
    $hamburger_sub_menu = Cache::remember('hamburger_sub_menu_'.$languageMain->code.'_'.$countryGroup->code, 7*24*60*60, function()use($mediapress){
        return $mediapress->menu('hamburger-sub-menu');
    });
    $activeLanguage = $mediapress->activeLanguage;
@endphp
@section('header')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KMFQTN2"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="overlay"></div>
    <div id="panel">
        <div class="close"></div>
        <div class="menu">
            <ul class="ust_menu">
                @foreach($header_menu as $menu)
                    <li>
                        @if( $menu->children->isNotEmpty() )
                            <a href="{!! $menu->url ?? 'javascript:void(0)' !!}">{!! $menu->name !!}</a>
                        <div class="submenu">
                            <div class="back"></div>
                            <ul>
                                @foreach($menu->children as $children)
                                    <li>
                                    @if( $children->children->isNotEmpty() )
                                        <div class="submenu">
                                           <div class="back"></div>
                                            <ul>
                                                @foreach($children->children as $child)
                                                    <li><a href="{!! $child->type == 1 ? $child->out_link : $child->url ?? '#' !!}">{!! $child->name !!}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <a href="{!! $children->type == 1 ? $children->out_link : $children->url !!}" {{ !is_null($children->target) ? 'target="'.$children->target.'"':'' }}>{!! $children->name !!}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @else
                            <a href="{!! $menu['url'] !!}" {{ !is_null($menu->target) ? 'target="'.$menu->target.'"':'' }}>{!! $menu['name'] !!}</a>
                        @endif
                    </li>
                @endforeach
            </ul>

            <div class="bottoms">
                <ul class="alt_menu">
                    @foreach($hamburger_sub_menu as $submenu)
                        <li><a href="{!! strip_tags($submenu->type == 1 ? $submenu->out_link : $submenu->url) !!}" rel="nofollow" target="{!! $submenu->target !!}">{!! $submenu->name !!}</a></li>
                    @endforeach

                </ul>
                @if(count($social_medias) > 0)
                    <nav>
                        @foreach( $social_medias as $media )
                            <a href="{!! $media['url'] !!}" target="_blank" rel="nofollow">
                                <img src="{!! $media['image'] !!}" alt="Social Media" width="30" height="30">
                            </a>
                        @endforeach
                    </nav>
                @endif
            </div>
        </div>
    </div>


    <div class="language-wrap">
        <div class="language-box">
            <div class="language-map-box">
                <div class="title">{!! LangPart('please_choose_your_country', 'Lütfen ülkenizi ve dilinizi seçiniz.') !!}</div>
                <div class="selects">
                    <div>
                        <select class="chosen-select form-control" id="ulke">
                            <option value="">{!! LangPart('selectCountry', 'Ülke Seçiniz') !!}</option>
                            @foreach($countries as $country)
                                <option data-country="{!! $country['slug'] !!}" value="{!! $country['code'] !!}" {!! !is_null($country_detail) && $country['code'] == $country_detail ? '':'' !!}>{!! LangPart(strtolower($country['name']), $country['name']) !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select class="nice-select change_lang disabled" id="langSelect">
                            <option value="" selected>{!! LangPart('selectLanguage', 'Dil Seçiniz') !!}</option>
                            <option value="{!! $activeLanguage->id !!}" >{!! LangPart(\Str::slug($activeLanguage->name), $activeLanguage->name) !!}</option>
                            @foreach( $mediapress->otherLanguages(1) as $language )
                                <option value="{!! $language['language']['id'] !!}">{!! LangPart(\Str::slug($language['language']->name), $language['language']->name) !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button onclick="changeLanguage()">{!! LangPart('okey', 'OKEY') !!}</button>
                    </div>
                </div>
                <div class="map-close"></div>
                <img data-src="{!! asset('assets/img/harta02.png') !!}" class="lazy" src="{!! asset('assets/img/lazy.jpg') !!}" alt="Harita">
            </div>
        </div>
    </div>
    <header class="header">
        <div id="search-page">
            <div class="container">
                <form action="{!! getUrlBySitemapId(SEARCH_ST_ID) !!}" method="get">
                    <div class="form-group">
                        <label><input type="text" name="q" placeholder="{!! strip_tags(LangPart('what_are_you_looking_for', 'What are you looking for?')) !!}" autocomplete="off"></label>
                        <button aria-label="Button"><i class="far fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-7">
                    <a href="{!! url($mediapress->homePageUrl->url) !!}" class="logo" aria-label="KEAS">
                        <img src="{!! settingSun('logo.desktop_logo') ?
                                image(settingSun('logo.desktop_logo')) :
                                asset('vendor/mediapress/images/logo-m.jpg') !!}" alt="KEAS" width="252" height="59">
                    </a>
                </div>
                <div class="col-md-9 col-5 text-right">
                    <div class="flex-menu">
                        @if($device != 'mobile')
                        <div class="menu">
                            <ul>
                                @php
                                    $category = get_category_by_id($countryGroup->id,$languageMain->id,1);
                                @endphp
                                @if(!is_null($category))
                                <li>
                                    <a href="javascript:void(0)">{!! mb_strtoupper($category->name) !!}</a>
                                    <div class="submenu megamenu">
                                        <div class="menus">
                                            <div class="row">
                                                @foreach($panel_categories as $category)
                                                <div class="col">
                                                    <div class="item">
                                                        <a href="{!! $category['url'] !!}">
                                                            <picture><img data-src="{!! $category['image'] !!}" src="{!! asset('assets/img/lazy.jpg') !!}" class="lazy" alt="{!! $category['name'] !!}"></picture>
                                                            <b>{!! $category['name'] !!}</b>
                                                            <span>{!! $category['detail'] !!}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                    @php
                                        $category = get_category_by_id($countryGroup->id,$languageMain->id,15);
                                    @endphp
                                @endif
                                @if(!is_null($category))
                                <li>
                                    <a href="javascript:void(0)">{!! mb_strtoupper($category->name) !!}</a>
                                    <div class="submenu megamenu">
                                        <div class="menus">
                                            <div class="row">
                                                @foreach($parke_categories as $category)
                                                    <div class="col">
                                                        <div class="item">
                                                            <a href="{!! $category['url'] !!}">
                                                                <picture><img data-src="{!! $category['image'] !!}" src="{!! asset('assets/img/lazy.jpg') !!}" class="lazy" alt="{!! $category['name'] !!}"></picture>
                                                                <b>{!! $category['name'] !!}</b>
                                                                <span>{!! $category['detail'] !!}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endif
                                @foreach($top_menu as $menu)
                                <li><a href="{!! $menu->url !!}">{!! $menu->name !!}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="lang" id="lang">
                            <span><i class="far fa-chevron-down"></i>{!! strtoupper($languageMain->code) !!}</span>
                        </div>
                        <div class="search"></div>
                        <div class="navbar">
                            <i>{!! LangPart('menu', 'MENU') !!}</i>
                            <div class="navs">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
