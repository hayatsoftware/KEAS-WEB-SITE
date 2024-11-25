@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
	$pages = $mediapress->data['pages'];
     \Carbon\Carbon::setlocale($mediapress->activeLanguage->code);
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/news.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('media_room', 'Basın Odası') !!}</a></li>
                    <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! $sitemap->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar">
                            @include('web.inc.media-menu')
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="content">
                            <h1>{!! $sitemap->detail->name !!}</h1>
                            @if($pages->isNotEmpty())
                            <div class="news news1">
                                <div class="row">
                                    @foreach($pages as $page)
                                        @php $detail = $page->detail; @endphp
                                    <div class="col-lg-4 col-md-6">
                                        <a href="{!! strip_tags($detail->url) !!}">
                                            <picture><img data-src="{!! image($page->f_) !!}" class="lazy" src="{!! asset('assets/img/lazy.jpg') !!}"  alt="{!! $detail->name !!}"></picture>
                                            <b>{!! $detail->name !!}</b>
                                         <em>{!! \Carbon\Carbon::parse($page->cdat_1)->translatedFormat('j F Y') !!}</em>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="pagerBox">
                                {!! $pages->links() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </article>
    </section>
@endsection
