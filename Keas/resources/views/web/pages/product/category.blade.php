@extends('web.inc.app')
@php
    $sitemap = $mediapress->data['sitemap'];
    $category = $mediapress->data['category'];
    $parent_category = $category->parent;
    $breadcrumbs = $mediapress->data['breadcrumbs'];
    $extras = $mediapress->data['extras'] ?? [];
    $documents = $mediapress->data['documents'] ?? [];
    $view_data = $mediapress->data['view_data'];
    $country = \Mediapress\Modules\MPCore\Models\Country::where('id', $country_detail)->first();

    if( isset($category->detail->f_zone_top_image) && !is_null($category->detail->f_zone_top_image) ){
        $bg = image($category->detail->f_zone_top_image);
    }else if( isset($parent_category->detail->f_zone_top_image) && !is_null($parent_category->detail->f_zone_top_image) ){
        $bg = image($parent_category->detail->f_zone_top_image);
    }else if($category->f_background ){
        $bg = image($category->f_background );
    }else{
        $bg = image($parent_category->f_background);
    }
@endphp
@push('styles')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/documents.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/products.css') !!}?v=01">
@endpush
@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="page_banner">
                <div class="breadcrump">
                    <ul>
                        @foreach($breadcrumbs as $crumb)
                        <li><a href="{!! $crumb['url'] !!}">{!! $crumb['name'] !!}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="page-title">
                    <div class="container">
                        <h1 data-in-effect="flipInX" class="effect">{!! $category->detail->name !!}</h1>
                    </div>
                </div>
                <div class="bg" style="background-image: url('{!! $bg !!}')"></div>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="tabs">
                    <ul id="tabs-nav">
                        <li class="active" data-filter=".urunler"><a href="#tab1">{!! LangPart('products_uppercase', 'ÜRÜNLER') !!}</a></li>
                        <li data-filter=".genel"><a href="#tab2">{!! LangPart('general_uppercase', 'GENEL ÖZELLİKLER') !!}</a></li>
                        <li data-filter=".dokumanlar"><a href="#tab3">{!! LangPart('documents_uppercase', 'DOKÜMANLAR') !!}</a></li>
                        @if( $category->detail->videos && strip_tags($category->detail->videos) != "" )
                            <li data-filter=".uygulamalar"><a href="#tab4">{!! LangPart('applications', 'UYGULAMALAR') !!}</a></li>
                        @endif
                    </ul>
                </div>
                <div class="content">
                    <div id="tabs-content">
                        <div id="tab1" class="tab-content">
                            <div id="productContent">
                                <products></products>
                            </div>
                        </div>
                        @php
                            // $category->detail->name'den gelen içeriği al
                            $categoryName = $category->detail->name;

                            // Eğer içerik "Floorpan" ile başlıyorsa bu kelimeyi sil
                            if (strpos($categoryName, 'Floorpan') === 0) {
                                $categoryName = substr($categoryName, strlen('Floorpan'));
                            }
                        @endphp
                        <div id="tab2" class="tab-content">
                            @foreach( $extras as $extra )
                                @if(isset($extra['general_info']) && !is_null($extra['general_info']))
                                    <div class="block ">
                                        <div class="titles">{!! $extra['title'] !!}</div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h3>{!! $categoryName !!} {!! LangPart('general_info', 'General Info') !!}</h3>
                                            </div>
                                            <div class="col-md-9">
                                                {!! $extra['general_info'] !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($extra['usages']) && !is_null($extra['usages']))
                                    <div class="block gfg">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h3>{!! $categoryName !!} {!! LangPart('usage_areas', 'Usage Areas') !!}</h3>
                                            </div>
                                            <div class="col-md-9">
                                                {!! $extra['usages'] !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($extra['advantages']) && !is_null($extra['advantages']) && $extra['advantages'] != "")
                                    <div class="block">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h3>{!! $categoryName !!} {!! LangPart('advantages', 'Advantages') !!}</h3>
                                            </div>
                                            <div class="col-md-9">
                                                {!! $extra['advantages'] !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($extra['classifications']))
                                    @include('web.pages.product.parts.classifications', ['classifications'=>$extra['classifications'], 'category'=>$extra['title']])
                                @endif
                                @if(isset($extra['surfaces']))
                                    @include('web.pages.product.parts.surfaces', ['surfaces'=>$extra['surfaces']])
                                @endif

                                @if(isset($category->f_layer_image) || isset($category->detail->f_layer_image_zone) || isset($parent_category->f_layer_image) || isset($parent_category->detail->f_layer_image_zone))
                                    @include('web.pages.product.parts.layers')
                                @endif
                                @if(isset($extra['features']))
                                    @include('web.pages.product.parts.features', ['features'=>$extra['features'], 'category'=>$category])
                                @endif
                                @if(isset($extra['certificates']))
                                    @include('web.pages.product.parts.certificates', ['certs'=>$extra['certificates']])
                                @endif
                                @if(isset($extra['technical']) && !is_null($extra['technical']))
                                    <div class="block">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h3>{!! LangPart('technical_properties', 'Technical Properties') !!}</h3>
                                            </div>
                                            <div class="col-md-9">
                                                {!! $extra['technical'] !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        </div>
                        <div id="tab3" class="tab-content">
                            @if($documents)
                            <div class="documents">
                                @foreach( $documents as $document )
                                <a href="{!! $document['file'] !!}">
                                    {!! $document['name'] !!}
                                    <div class="rights">
                                        <small>{!! $document['size'] !!}</small>
                                        <span>{!! LangPart('download', 'DOWNLOAD') !!}</span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @if( $category->detail->videos && !empty(strip_tags($category->detail->videos)) )
                            @php $videos = explode(',', strip_tags($category->detail->videos)) @endphp
                            <div id="tab4" class="tab-content" style="">
                                <div class="videos">
                                    <div class="row">
                                        @foreach($videos as $video)
                                            <div class="col-lg-6">
                                                <a href="https://youtu.be/{!! $video !!}" data-fancybox="">
                                                    <picture>
                                                        <img src="https://img.youtube.com/vi/{!! $video !!}/hqdefault.jpg" alt="Video" style="">
                                                        <div class="playIco">
                                                            <i class="fas fa-play"></i>
                                                        </div>
                                                    </picture>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </article>
    </section>
@endsection
@push('pre_scripts')
    <script>



        window.trans = {
            'filter' : '{!! strip_tags(LangPart('filter', 'Filter')) !!}',
            'search_product' : '{!! strip_tags(LangPart('search_product', 'Search product')) !!}',
            'country': '{!! strip_tags(LangPart('country', 'Country')) !!}',
            'country_text': '{!! strip_tags(LangPart(\Str::slug($country->native, '-'), 'Türkiye')) !!}',
            'change': '{!! strip_tags(LangPart('change', 'Change')) !!}',
            'categories' : '{!! strip_tags(LangPart('categories', 'Categories')) !!}',
            'brands' : '{!! strip_tags(LangPart('brands', 'Brands')) !!}',
            'products_loading' : '{!! strip_tags(LangPart('products_loading', 'Products are loading...')) !!}',
            'listed_product' : '{!! strip_tags(LangPart('listed_products', 'products are listing.')) !!}',
            'decors' : '{!! strip_tags(LangPart('decors', 'Decors')) !!}',
            'surface' : '{!! strip_tags(LangPart('surface', 'Surface')) !!}',
            'extra_features': '{!! strip_tags(LangPart('extra_features', 'Extra Features')) !!}',
            'dimensions':'{!! strip_tags(LangPart('dimensions', 'Dimensions')) !!}',
            'thicknesses':'{!! strip_tags(LangPart('thicknesses', 'Thicknesses')) !!}',
            'locks' : '{!! strip_tags(LangPart('locks', 'Locks')) !!}',
            'bevels': '{!! strip_tags(LangPart('bevels', 'Bevels')) !!}',
            'classes': '{!! strip_tags(LangPart('class_info', 'Class Info')) !!}',
            'height': '{!! strip_tags(LangPart('height', 'Height')) !!}',
            'clear_filter': '{!! strip_tags(LangPart('clear_filter', 'Clear Filters')) !!}',
            'only_news' : '{!! strip_tags(LangPart('only_news', 'Sadece Yeniler')) !!}',
            'decor_view' : '{!! strip_tags(LangPart('decor_view', 'Decor View')) !!}',
            'interior_view' : '{!! strip_tags(LangPart('interior_view', 'Interior View')) !!}',
            'series' : '{!! strip_tags(LangPart('series', 'Series')) !!}',
            'new': '{!! strip_tags(LangPart('new', 'YENİ')) !!}',
            'coming_soon': '{!! strip_tags(LangPart('coming_soon', 'YAKINDA')) !!}',
            'texture' : '{!! strip_tags(LangPart('texture', 'Texture')) !!}',
            'water_resistance': '{!! strip_tags(LangPart('water_resistance', 'Water Resistance')) !!}'
        };
        window.category_id = {!! $category->id !!};
        window.category_parent_id = {!! $category->category_id !!};
        window._token = '{!! csrf_token() !!}';
        window.category_url = '{!! $category->detail->url !!}';
        window.panel_image = '{!! asset('assets/img/large/panel01.jpg') !!}';
        view_data = @json($view_data);
        window.searchData = @json(request()->input());

    </script>
@endpush
@push('scripts')
    <script src="{!! asset('frontend/assets/js/bootstrap.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/products.js?v=01') !!}"></script>
@endpush
