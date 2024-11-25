@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $categories = $mediapress->data['categories'] ?? [];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/administration.css') !!}">
    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('about_us', 'About Us') !!}</a></li>
                    <li><a href="#">{!! LangPart('management', 'Yönetim') !!}</a></li>
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
                            @foreach( $categories as $category )
                            <div class="block">
                                <div class="head">{!! $category->detail->name !!}</div>
                                <div class="row">
                                    @foreach( $category->pages()->orderBy('order')->get() as $page )
                                    @php $detail = $page->detail; @endphp
                                    <div class="col-xl-3 col-lg-4 col-md-4">
                                        <div class="list">
                                            <picture><img src="{!! image($detail->f_ ?? $page->f_) !!}" alt="{!! strip_tags($detail->name) !!}"></picture>
                                            <div class="name">{!! $detail->name !!}</div>
                                            <ul>
                                                @if( $detail->summary )
                                                    <li>{!! $detail->summary !!}</li>
                                                @endif
                                                @if($detail->summary_two)
                                                    <li>{!! $detail->summary_two !!}</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
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
@push('scripts')
    <script src="{!! asset('frontend/assets/js/page.js') !!}"></script>
@endpush
