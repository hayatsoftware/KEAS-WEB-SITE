@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $pages = $mediapress->data['pages'];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/innovation.css?v=04') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('abouts_us', 'About Us') !!}</a></li>
                    <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! $sitemap->detail->name !!}</a></li>
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
                            @if($pages->isNotEmpty())

                            <div class="row">
                                @foreach($pages as $page)
                                <div class="col-xl-4 col-md-6">
                                    <div class="item btn_list">
                                        <picture>
                                            <img data-src="{!! $page->detail->f_ ? image($page->detail->f_):image($page->f_) !!}" src="{!! asset('assets/img/lazy.jpg') !!}" class="lazy" alt="{!! $page->detail->name !!}">
                                        </picture>
                                        <b>{!! $page->detail->name !!}</b>
                                        <span class="txt">{!! strip_tags($page->detail->detail) !!}</span>
                                       @if( $page->cint_1 == 2 && $page->detail->button_text )
                                       <a href="javascript:void(0)" class="btn01 id-01"><div class="icon"><img src="{!! asset('assets/img/box.svg') !!}"></div>{!! $page->detail->button_text !!}</a>
                                        @endif
                                        @if( $page->cint_1 == 3 && $page->detail->button_text )
                                        <a href="javascript:void(0)" class="btn01 id-02"><div class="icon"><img src="{!! asset('assets/img/room.svg') !!}"></div>{!! $page->detail->button_text !!}</a>
                                        @endif
                                        @if( $page->cint_1 == 4 && $page->detail->button_text )
                                        <a href="javascript:void(0)" class="btn01 id-03"><div class="icon"><img src="{!! asset('assets/img/camera.svg') !!}"></div>{!! $page->detail->button_text !!}</a>
                                        @endif
                                    </div>
                                </div>


                                    @if( $page->cint_1 == 2 && $page->detail->button_url )
                                        <div id="id-01" class="modals">
                                            <div class="inner">
                                                <div class="all" data-src="{!! strip_tags($page->detail->button_url) !!}">
                                                    <div class="close"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if( $page->cint_1 == 3 && $page->detail->button_url )
                                        <div id="id-02" class="modals">
                                            <div class="inner">
                                                <div class="all" data-src="{!! strip_tags($page->detail->button_url) !!}">
                                                    <div class="close"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if( $page->cint_1 == 4 && $page->detail->button_url )
                                        <div id="id-03" class="modals">
                                            <div class="inner">
                                                <div class="all" data-src="{!! strip_tags($page->detail->button_url) !!}">
                                                    <div class="close"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>


@endsection
@push('scripts')
    <script src="{!! asset('frontend/assets/js/sanal.js?v=02') !!}"></script>
    <script src="{!! asset('frontend/assets/js/page.js') !!}"></script>
@endpush
