@extends('web.inc.app')

@php
    $sitemap = $mediapress->data['sitemap'];
    $documents = $mediapress->data['documents'];
@endphp
<section class="section">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/innovation.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/certificates.css') !!}">

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
                        <div class="block">
                            <div class="documents">
                                @foreach($documents as $document)
                                    <a href="{!! $document['file'] !!}" target="_blank">
                                        {{ $document['name'] }}
                                        <div class="rights">
                                            <small>{!! $document['size'] !!}</small>
                                            <span>{!! LangPart('download', 'Download') !!}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>
@push('scripts')
    <script src="{!! asset('frontend/assets/js/page.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/kalite-belgeleri-tab.js') !!}"></script>
@endpush


