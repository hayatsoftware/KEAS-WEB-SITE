@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $catalogues = $mediapress->data['catalogues'] ?? [];
@endphp
@push('styles')
    <style>
        .fancybox-slide {
            padding: 0 !important;
        }
    </style>
@endpush
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
                            @foreach($catalogues as $catalogue)
                            <div class="identity catalog_down">
                                <div class="head">{!! $catalogue['name'] !!}</div>
                                <div class="row">
                                    @foreach( $catalogue['files'] as $file )
                                        @if($file['type'] == 'embed')
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                                <a href="{!! $file['file'] !!}" data-fancybox data-type="iframe">
                                                    <picture><img src="{!! $file['cover'] !!}" alt="" class="lazy" style=""></picture>
                                                    <b>{!! $file['name'] !!}</b>
                                                </a>
                                            </div>
                                        @else
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                                <a href="{!! $file['file'] !!}" target="_blank">
                                                    <picture><img src="{!! $file['cover'] !!}" alt="" class="lazy" style=""></picture>
                                                    <b>{!! $file['name'] !!}</b>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
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
