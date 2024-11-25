@extends('web.inc.app')

@php
    $sitemap = $mediapress->data['sitemap'];
    $page = $mediapress->data['page'];
    $sustainabilitySitemap = \Mediapress\Modules\Content\Models\Sitemap::find(SUSTAINABILITY_ST_ID);
    $InnovationPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', SUSTAINABILITY_ST_ID)->where('cint_1', 1)->first();
@endphp

@section('content')
    @if($page->cint_1 == 1)
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/innovation.css') !!}">
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/konsept.css') !!}">
    @endif
    @if( $page->cint_1 == 2 || $page->cint_1 == 3 )
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/general-approach.css') !!}">
    @endif

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('abouts_us', 'About Us') !!}</a></li>
                    <li><a href="{!! strip_tags($sustainabilitySitemap->detail->url) !!}">{!! $sustainabilitySitemap->detail->name !!}</a></li>
                    <li><a href="{!! strip_tags($InnovationPage->detail->url) !!}">{!! $InnovationPage->detail->name !!}</a></li>
                    <li><a href="{!! strip_tags($page->detail->url) !!}">{!! $page->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar">
                            @include('web.inc.about-us-menu', ['active_url'=>strip_tags($sustainabilitySitemap->detail->url)])
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="content">
                            <h1>{!! $page->detail->name !!}</h1>
                            @if($page->cint_1 == 1)
                                @include('web.pages.innovation.templates.default')
                            @endif
                            @if( $page->cint_1 == 2 )
                                @include('web.pages.innovation.templates.listing')
                            @endif
                            @if( $page->cint_1 == 3 )
                                @include('web.pages.innovation.templates.listing-lef-right')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
@push('scripts')
    <script src="{!! asset('frontend/assets/js/page.js') !!}"></script>
    @if( $page->cint_1 == 3 )
        <script src="{!! asset('frontend/assets/js/inovasyon.js') !!}"></script>
    @endif
@endpush
