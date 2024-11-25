@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $sitemap_detail = $sitemap->detail;
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('abouts_us', 'About Us') !!}</a></li>
                    <li><a href="#">{!! LangPart('policies', 'Policies') !!}</a></li>
                    <li><a href="{!! strip_tags($sitemap_detail->url) !!}">{!! $sitemap_detail->name !!}</a></li>
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
                            <h1>{!! $sitemap_detail->name !!}</h1>
                            {!! $sitemap_detail->detail !!}
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>

@endsection
