@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/form.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('keas_club', 'Keas Club') !!}</a></li>
                    <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! $sitemap->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        @include('web.inc.login-sidebar')
                    </div>
                    <div class="col-lg-9">
                        @if (Session::has('user_activation'))
                            <div class="alert alert-success">{{ Session::get('user_activation') }}</div>
                        @endif
                        <div class="content" style="background-image: url('{!! image($sitemap->f_) !!}')">
                            <div class="club_content">
                                <h1><img src="{!! image($sitemap->detail->f_) !!}" alt="Login"></h1>
                                <div class="text">
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
