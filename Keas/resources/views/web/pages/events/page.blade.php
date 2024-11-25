@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $keas_consept = \Mediapress\Modules\Content\Models\Sitemap::find(KEAS_CONCEPT_ST_ID);
    $page = $mediapress->data['page'];
    $other_pages = $mediapress->data['other_events'] ?? [];
    \Carbon\Carbon::setlocale($mediapress->activeLanguage->code);
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/konsept.css') !!}">
    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('abouts_us', 'About Us') !!}</a></li>
                    <li><a href="{!! strip_tags($keas_consept->detail->url) !!}">{!! $keas_consept->detail->name !!}</a></li>
                    <li><a href="{!! strip_tags($page->detail->url) !!}">{!! $page->detail->name !!}</a></li>
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
                            <h1>{!! $page->detail->name !!}</h1>
                            <div class="row">
                                <div class="col-lg-7">
                                    {!! $page->detail->detail !!}
                                </div>
                                <div class="col-lg-5">
                                    <div class="sticky">
                                        <img src=" {!! image($page->f_) !!}"  alt="">
                                    </div>
                                </div>
                            </div>


                            <div class="share">
                                <ul>
                                    <li class="back"><a href="{!! getUrlBySitemapId(KEAS_CONCEPT_ST_ID) !!}">{!! LangPart('back', 'BACK') !!}</a></li>
                                    <li>
                                        {!! LangPart('share', 'PAYLAŞ') !!}
                                        <ul>
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={!! url($page->detail->url) !!}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="https://twitter.com/intent/tweet?url={!! url($page->detail->url) !!}" target="_blank" rel="noopener">
                                                    <img src="{!! asset('assets/img/x-twitter-brands-solid.svg') !!}" alt="Twitter">
                                                </a></li>
                                            <li><a href="https://www.linkedin.com/shareArticle?url={!! strip_tags($page->detail->url) !!}&title={!! strip_tags($page->detail->name) !!}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            @if( $page->f_gallery )
                            <div class="photo_gallery mt-4">
                                <h2>{!! LangPart('photo_gallery_uppercase', 'FOTO GALERİ') !!}</h2>
                                <div class="content-gallery">
                                    @if( $page->f_gallery[0] )
                                        @foreach( $page->f_gallery as $gallery )
                                        <a data-fancybox="gallery" href="{!! strip_tags(image($gallery)) !!}" data-caption="">
                                        <span>
                                            <img class="lazy" data-src="{!! strip_tags(image($gallery)) !!}" alt="{!! strip_tags($page->detail->name) !!}">
                                        </span>
                                        </a>
                                        @endforeach
                                    @else
                                        <a data-fancybox="gallery" href="{!! strip_tags(image($page->f_gallery)) !!}" data-caption="">
                                        <span>
                                            <img class="lazy" data-src="{!! strip_tags(image($page->f_gallery)) !!}" alt="{!! strip_tags($page->detail->name) !!}">
                                        </span>
                                        </a>
                                    @endif

                                </div>
                            </div>
                            @endif
                            @if($other_pages->isNotEmpty())
                            <div class="events float-left w-100">
                                <h2>{!! LangPart('other_events', 'OTHER EVENTS') !!}</h2>
                                <div class="row">
                                    @foreach($other_pages as $event)
                                        @if($event->detail)
                                            <div class="col-lg-4 col-md-6">
                                                <a href="{!! strip_tags($event->detail->url) !!}">
                                                    <picture>
                                                        <img data-src="{!! image($event->f_) !!}" class="lazy" src="{!! image($event->f_) !!}"  alt="">
                                                    </picture>
                                                    <b>{!! $event->detail->name !!}</b>

                                                    <!--<em>{!! \Carbon\Carbon::parse($event->cvar_1)->translatedFormat('j F Y') !!}</em>-->
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
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
    <script src="{!! asset('frontend/assets/js/page.js') !!}"></script>
@endpush
