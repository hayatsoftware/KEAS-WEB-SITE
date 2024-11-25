@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('about_us', 'About Us') !!}</a></li>
                    <li><a href="#">{!! LangPart('management', 'Management') !!}</a></li>
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
                            <div class="row">

                                <div class="col-md-5 mt-3 order-md-1">
                                    <div class="sticky">
                                        <img src="{!! image($sitemap->detail_f ?? $sitemap->f_) !!}" alt="{!! strip_tags($sitemap->detail->name) !!}">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    {!! $sitemap->detail->detail !!}
                                </div>
                            </div>
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
