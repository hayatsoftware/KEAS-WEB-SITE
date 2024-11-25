@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $sitemap_detail = $sitemap->detail;
    $sliders = $mediapress->data['sliders'] ?? [];
    $categories = $mediapress->data['categories'] ?? [];
    $trends = $mediapress->data['trends'] ?? [];
    $app_sliders = $mediapress->data['app_sliders'] ?? [];
    $boxes = $mediapress->data['boxes'] ?? [];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/home.css?v=02') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/slick.css') !!}">

    @include('web.pages.homepage.parts.slider', ['sliders'=>$sliders])
    <h1 style="display: none;">Kastamonu Entegre</h1>
    <section class="section float-left w-100">
        <div class="box1">
            <div class="container">
                <div class="row">
                    @foreach( $categories as $category )
                    <div class="col-md-6">
                        <a href="{!! $category['url'] !!}">
                            <picture>
                                <source media="(max-width:500px)" srcset="Mobil görsel src alanı">
                                <img data-src="{!! $category['image'] !!}" src="{!! asset('assets/img/lazy.jpg') !!}" class="lazy" alt="{!! strip_tags($category['name']) !!}">
                            </picture>
                            <div class="text">
                                <h2>{!! $category['name'] !!}</h2>
                                <div class="txt">
                                    {!! $category['detail'] !!}
                                </div>
                                <span class="btn black">{!! LangPart('products_uppercase', 'PRODUCTS') !!}</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="box2">
            @php
                $section_image = $sitemap_detail->f_section_image ? image($sitemap_detail->f_section_image) : image($sitemap->f_section_image);
                $section_image = $section_image->resize(['w'=>1920,'h'=>700]);
            @endphp

            <picture>
                <source media="(max-width:500px)" srcset="Mobil görsel src alanı">
                <img data-src="{!! $section_image !!}" class="lazy" src="{!! asset('assets/img/lazy.jpg') !!}" alt="{!! strip_tags($sitemap_detail->section_title) !!}" width="1920" height="700">
            </picture>

            <a href="{!! strip_tags($sitemap_detail->section_url) !!}" class="txt" aria-label="Sen Tasarla">
                <div class="container-fluid">
                    <div class="text">
                        <div>
                            <b>{!! $sitemap_detail->section_title !!}</b>
                            <p>{!! $sitemap_detail->section_slogan !!}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="box3">
            <div class="container text-center">
                <h3>{!! LangPart('trends', 'TRENDS') !!}</h3>
                <div class="title">{!! LangPart('trends_description', 'Sektörden son gelişmeler ve haberler için bizi takip edin.') !!}</div>
            </div>
            <div class="trend_slider">
                @foreach( $trends as $trend )
                <div class="item">
                    <a href="{!! $trend['url'] !!}">
                        <picture><img data-lazy="{!! $trend['image'] !!}" src="{!! asset('assets/img/lazy.jpg') !!}" alt="{!! $trend['name'] !!}"></picture>
                        <b>{!! $trend['name'] !!}</b>
                    </a>
                </div>
                @endforeach
            </div>
            <a href="{!! getUrlBySitemapId(BLOG_ST_ID) !!}" class="btn white">{!! LangPart('all', 'ALL') !!}</a>
        </div>
        <div class="box4">
            <div class="box4_slider">
                @foreach($app_sliders as $slider)
                <div class="item">
                    <picture>
                        <source media="(max-width:500px)" srcset="Mobil görsel src alanı">
                        <img src="{!! asset('assets/img/lazy.jpg') !!}" data-lazy="{!! $slider['image'] !!}" alt="{!! $slider['title'] !!}" width="1920" height="700">
                    </picture>
                    <div class="txt">
                        <div class="container-fluid">
                            <div class="text">
                                <div>
                                    <h2>{!! $slider['title'] !!}</h2>
                                    {!! $slider['slogan'] !!}
                                    <nav>
                                        @if($slider['google_store'])
                                        <a href="{!! $slider['google_store'] !!}"><img src="{!! asset('assets/img/google-play.svg') !!}" alt="Google Play" width="150" height="50"></a>
                                        @endif
                                        @if($slider['app_store'])
                                        <a href="{!! $slider['app_store'] !!}"><img src="{!! asset('assets/img/app-store.svg') !!}" alt="App Store" width="150" height="50"></a>
                                        @endif
                                    </nav>
                                    @if( !is_null( $slider['button_text'] ) )
                                        <a href="{!! $slider['button_url'] !!}" class="btn mt-4">{!! $slider['button_text'] !!}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="box5">
            <div class="container">
                <div class="row">
                    @foreach($boxes as $box)
                    <div class="{!! $box['type'] == 'small' ? 'col-md-4':'col-md-6' !!}">
                        <div class="item">
                            <a href="{!! $box['url'] !!}">
                                <picture><img data-src="{!! $box['image'] !!}" src="{!! asset('assets/img/lazy.jpg') !!}" class="lazy" alt="{!! strip_tags($box['name']) !!}"></picture>
                                <b>{!! $box['name'] !!}</b>
                                <span class="txt">{!! $box['detail'] !!}</span>
                            </a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{!! asset('frontend/assets/js/slick.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/home.js') !!}"></script>
@endpush
