@extends('web.inc.app')

@php
    $sitemap = $mediapress->data['sitemap'];
    $pages = $mediapress->data['pages'] ?? [];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/principles.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('about_us', 'About Us') !!}</a></li>
                    <li><a href="{!! $sitemap->detail->url !!}">{!! $sitemap->detail->name !!}</a></li>
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
                            <div class="principles_list">
                                @foreach($pages as $page)
                                <div class="list">
                                    <div class="icon"><img src="{!! image($page->f_) !!}" alt="PRENSİPLERİMİZ"></div>
                                    <h3>{!! $page->detail->name !!}</h3>
                                    {!! $page->detail->detail !!}
                                </div>
                                @endforeach
                            </div>
                            <a href="{!! strip_tags($sitemap->detail->catalogue) !!}" class="catalog" target="_blank">{!! LangPart('digital_catalogue', 'DIGITAL CATALOGUE') !!}</a>

                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
@push('scripts')
    <script src="{!! asset('frontend/assets/js/page.js') !!}"></script>
@endpush
