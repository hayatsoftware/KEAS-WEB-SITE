@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $pages = $mediapress->data['pages'] ?? [];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/innovation.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('abouts_us', 'About Us') !!}</a></li>
                    <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! $sitemap->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar">
                            @include('web.inc.about-us-menu')
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="content">
                            <h1>{!! $sitemap->detail->name !!}</h1>
                            {!! $sitemap->detail->detail !!}
                            <p>&nbsp;</p>
                            <div class="row">
                                @foreach( $pages as $page )
                                <div class="col-lg-4 col-md-6">
                                    <div class="item">
                                        <a href="{!! $page->detail->url !!}">
                                            <picture>
                                                <img data-src="{!! strip_tags($page->detail->f_) ? image(strip_tags($page->detail->f_))  : image(strip_tags($page->f_))!!}" class="lazy" alt="">
                                            </picture>
                                            <b>{!! $page->detail->name !!}</b>
                                            <span class="txt">{!! $page->detail->detail ? \Str::limit(strip_tags($page->detail->detail), 150) : "" !!}</span>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
@push('scripts')
    <script src="{!! mp_asset('frontend/assets/js/page.js') !!}"></script>
    <script>
        $('.section .article .content .list:nth-child(odd) .row .col-lg-6:first-child').addClass('order-lg-1')
    </script>
@endpush
