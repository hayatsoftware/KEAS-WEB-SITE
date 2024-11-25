@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $page = $mediapress->data['page'];
    $category = $page->categories[0];
    $page_detail = $page->detail;
    $sitemap_detail = $sitemap->detail;
    $others = $category->pages()
    ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->where(function($q){
                        return $q->where('name', '!=', '');
                    });
    })
    ->take(3)
    ->orderBy('created_at')
    ->get()
    ->except([$page->id]);
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/trendler.css?v=01') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('media_room', 'Basın Odası') !!}</a></li>
                    <li><a href="{!! getUrlBySitemapId(BLOG_ST_ID) !!}">{!! $sitemap_detail->name !!}</a></li>
                    <li><a href="{!! $category->detail->url !!}">{!! $category->detail->name !!}</a></li>
                    <li><a href="{!! $page_detail->url !!}">{!! $page_detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="content">
                    <h1>{!! $page_detail->name !!}</h1>
                    <div class="row">
                        <div class="col-md-8 pr-md-5">
                            {!! $page_detail->detail !!}
                            <div class="share">
                                <ul>
                                    <li class="back"><a href="{!! getUrlBySitemapId(BLOG_ST_ID) !!}">{!! LangPart('back', 'BACK') !!}</a></li>
                                    <li>
                                        {!! LangPart('share', 'SHARE') !!}
                                        <ul>
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={!! url($page->detail->url) !!}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li>
                                            <!--<li><a href="https://twitter.com/intent/tweet?url={!! url($page->detail->url) !!}" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></li>-->
                                            <li><a href="https://www.linkedin.com/shareArticle?url={!! strip_tags($page->detail->url) !!}&title={!! strip_tags($page->detail->name) !!}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sticky">
                                <img src="{!! image($page->f_) !!}" alt="{!! strip_tags($page->detail->name) !!}">
                            </div>
                        </div>
                    </div>
                    <div class="other">
                        <h3>{!! LangPart('other_categories', 'OTHER :category', ['category'=>mb_strtoupper($category->detail->name)]) !!}</h3>
                        <div class="row pb-5">
                            @foreach( $others as $page )
                            <div class="col-lg-4 col-md-6">
                                <div class="item">
                                    <a href="{!! $page->detail->url !!}">
                                        <picture><img data-src="{!! image($page->f_) !!}" class="lazy" alt="{!! strip_tags($page->detail->name) !!}"></picture>
                                        <b>{!! $page->detail->name !!}</b>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </article>
    </section>
@endsection
