@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
	$pages = $mediapress->data['pages'];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/corporate-identity.css') !!}">
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
                            <div class="identity">
                                <div class="row">
                                    @foreach($pages as $page)
                                    <div class="col-lg-4 col-md-6">
                                        <a href="{!! image($page->f_identify_file ) !!}" download>
                                            <picture><img data-src="{!! image($page->f_) !!}" src="{!! asset('assets/img/lazy.jpg') !!}" alt="" class="lazy"></picture>
                                            <b>{!! $page->detail->name !!}</b>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </article>
    </section>
@endsection
