@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $page = $mediapress->data['page'];
    $sustainabilitySitemap = \Mediapress\Modules\Content\Models\Sitemap::find(SUSTAINABILITY_ST_ID);
    $qualityPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', SUSTAINABILITY_ST_ID)->where('cint_1', 2)->first();
    $qualityPageSub = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', QUALITY_SUB_PAGE_ST_ID)->where('cint_1', 4)->first();
    $qualityPageSubParent = $qualityPageSub->parent;
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/innovation.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('abouts_us', 'About Us') !!}</a></li>
                    <li><a href="{!! strip_tags($sustainabilitySitemap->detail->url) !!}">{!! $sustainabilitySitemap->detail->name !!}</a></li>
                    <li><a href="{!! strip_tags($qualityPage->detail->url) !!}">{!! $qualityPage->detail->name !!}</a></li>
                    <li><a href="{!! strip_tags($qualityPageSubParent->detail->url) !!}">{!! $qualityPageSubParent->detail->name !!}</a></li>
                    <li><a href="{!! strip_tags($qualityPageSub->detail->url) !!}">{!! $qualityPageSub->detail->name !!}</a></li>
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
                            {!! $page->detail->detail !!}
                            <div class="share">
                                <ul class="text-left">
                                    <li class="back b-none"><a href="{!! $qualityPageSub->detail->url !!}">{!! LangPart('back', 'Back') !!}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
