@extends('web.inc.app')

@php
    $sitemap = $mediapress->data['sitemap'];
    $pages = $mediapress->data['blog_pages'];
    $slider_pages =  $mediapress->data['slider_pages'] ?? [];
    $categories = $mediapress->data['categories'] ?? [];
    $sitemap_detail = $sitemap->detail;
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/slick.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/trendler.css?v=01') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('media_room', 'Basın Odası') !!}</a></li>
                    <li><a href="{!! getUrlBySitemapId(BLOG_ST_ID) !!}">{!! $sitemap_detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="content">
                    <h1 style="display: none">{!! $sitemap_detail->name !!}</h1>
                    @if($slider_pages)
                    <div class="trend_slider">
                        @foreach($slider_pages as $page)
                        <div class="item">
                            <a href="{!! $page->detail->url !!}">
                                <picture><img data-lazy="{!! image($page->f_banner) !!}"  alt="{!!strip_tags($page->detail->name) !!}"></picture>
                                <span>
                                    <b>{!! $page->detail->name !!}</b>
                                </span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="filterBtn">
                        <span>{!! LangPart('filter', 'Filter') !!}</span>
                    </div>
                    <div class="link">
                        <div class="closes"></div>
                        <a href="#" class="active">{!! LangPart('all', 'TÜMÜ') !!}</a>
                        @foreach($categories as $category)
                            @php
                                $count = 0;
                                foreach($category->pages as $page){
                                    if(strip_tags($page->detail->name) != "" && $page->detail){
                                        $count++;
                                    }
                                }
                            @endphp
                            @if($count > 0)
                                <a href="{!! $category->detail->url !!}">{!! $category->detail->name !!}</a>
                            @endif
                        @endforeach
                    </div>
                    <div class="row pb-5 trend_list">
                        @foreach($pages as $page)
                        <div class="col-md-4 col-lg-3 col-md-6">
                            <div class="item">
                                <a href="{!! $page->detail->url !!}">
                                    <picture><img data-src="{!! image($page->f_) !!}" class="lazy" alt=""></picture>
                                    <h2>{!! $page->detail->name !!}</h2>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="pagerBox">
                        {!! $pages->links() !!}

                    </div>
                </div>

            </div>
        </article>
    </section>
@endsection
@push('scripts')
    <script src="{!! asset('frontend/assets/js/slick.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/trendler.js') !!}"></script>
@endpush
