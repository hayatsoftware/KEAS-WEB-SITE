@extends('web.inc.app')

@php
    $sitemap = $mediapress->data['sitemap'];
    $page = $mediapress->data['page'];
    $mainPage = $page->parent;
    $sustainabilitySitemap = \Mediapress\Modules\Content\Models\Sitemap::find(SUSTAINABILITY_ST_ID);
    $qualityPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', SUSTAINABILITY_ST_ID)->where('cint_1', 2)->first();
@endphp

@section('content')
    @if( $page->cint_1 == 0 )
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/innovation.css') !!}">
    @endif
    @if($page->cint_1 == 1 || $page->cint_1 == 2 || $page->cint_1 == 3 || $page->cint_1 == 5)
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/certificates.css') !!}">
    @endif
    @if( $page->cint_1 == 4 )
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
        <link rel="stylesheet" href="{!! asset('frontend/assets/css/innovation.css') !!}">
    @endif
    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('abouts_us', 'About Us') !!}</a></li>
                    <li><a href="{!! strip_tags($sustainabilitySitemap->detail->url) !!}">{!! $sustainabilitySitemap->detail->name !!}</a></li>
                    <li><a href="{!! strip_tags($qualityPage->detail->url) !!}">{!! $qualityPage->detail->name !!}</a></li>
                    <li><a href="{!! strip_tags($mainPage->detail->url) !!}">{!! $mainPage->detail->name !!}</a></li>
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
                            @if( $page->cint_1 == 0 )
                                {!! $page->detail->detail !!}
                            @endif
                            @if($page->cint_1 == 1)
                                @include('web.pages.productqualitydocuments.sitemap', ['sitemap_id'=>PRODUCT_QUALITY_DOCUMENTS_ST_ID, 'mediapress'=>$mediapress])
                            @endif
                            @if($page->cint_1 == 2)
                                @include('web.pages.productqualitydocuments.sitemap', ['sitemap_id'=>QUALITY_STATEMENTS_DOCUMENTS_ST_ID, 'mediapress'=>$mediapress])
                            @endif
                            @if($page->cint_1 == 3)
                                @include('web.pages.productqualitydocuments.sitemap', ['sitemap_id'=>WARRANTY_DOCUMENTS_ST_ID, 'mediapress'=>$mediapress])
                            @endif
                            @if( $page->cint_1 == 4 )
                                @include('web.pages.ourpolicies.sitemap', ['sitemap_id'=>OUR_POLICIES_ST_ID, 'mediapress'=>$mediapress])
                            @endif
                            @if($page->cint_1 == 5)
                                @include('web.pages.productqualitydocuments.sitemap', ['sitemap_id'=>OUR_DOCUMENTS_ST_ID, 'mediapress'=>$mediapress])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>

@endsection
@push('scripts')
    <script src="{!! mp_asset('frontend/assets/js/page.js') !!}"></script>
    @if( $page->cint_1 == 1 || $page->cint_1 == 2 || $page->cint_1 == 3 || $page->cint_1 == 5 )
        <script src="{!! mp_asset('frontend/assets/js/kalite-belgeleri-tab.js') !!}"></script>
    @endif
@endpush
