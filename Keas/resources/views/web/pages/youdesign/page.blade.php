@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
	$page = $mediapress->data['page'];
    $subPages = $mediapress->data['sub_pages'];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/usta-eller.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('abouts_us', 'About Us') !!}</a></li>
                    <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! $sitemap->detail->name !!}</a></li>
                    <li><a href="{!! strip_tags($page->detail->url) !!}">{!! $page->detail->name !!}</a></li>
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
                            <h1>{!! $page->detail->name !!}</h1>
                            <div class="row mb-5">

                                <div class="col-lg-6 order-lg-1">
                                    <div class="sticky">
                                        <img src="{!! image($page->f_right_image) !!}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    {!! $page->detail->detail !!}
                                </div>
                            </div>

                            @if($subPages->isNotEmpty())
                            <div class="qrkod">
                                <div class="row">
                                    @foreach($subPages as $page)
                                    <div class="col-md-4 col-sm-6">
                                        <a href="{!! strip_tags($page->detail->app_url) !!}" target="_blank">
                                            @if( $page->detail->f_ )
                                            <figure>
                                                <img src="{!! image($page->detail->f_) !!}" alt="">
                                            </figure>
                                            @endif
                                            <span><img src="{!! image($page->f_icon) !!}" alt="{!! strip_tags($page->detail->name) !!}"></span>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
@push('scripts')
    <script src="{!! mp_asset('assets/js/page.js') !!}"></script>
@endpush