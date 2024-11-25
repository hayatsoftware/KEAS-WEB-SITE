@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $events = $mediapress->data['events'] ?? [];
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
                            <div class="row">
                                <div class="col-lg-7">
                                    {!! $sitemap->detail->detail !!}
                                </div>
                                <div class="col-lg-5">
                                    <div class="sticky">
                                        <div class="picture">
                                            <a href="{!! strip_tags(image($sitemap->f_)) !!}" data-fancybox><img src="{!! strip_tags(image($sitemap->f_)) !!}" alt="{!! strip_tags(image($sitemap->detail->name)) !!}"></a>
                                        </div>
                                        @php
                                            if( $sitemap->detail->video_url && !is_null(strip_tags($sitemap->detail->video_url)) ){
                                                $videos = explode(',', strip_tags($sitemap->detail->video_url));
                                            }else{
                                                $videos = explode(',', $sitemap->cvar_1);
                                            }
                                        @endphp
                                        @if(count($videos) > 0)
                                        <div class="videos">
                                            @foreach($videos as $video)
                                            <a href="{!! $video !!}" data-fancybox>
                                                <picture>
                                                    <img src="{!! strip_tags(image($sitemap->f_video)) !!}" src="{!! asset('assets/img/lazy.jpg') !!}"  alt="Video">
                                                    <div class="playIco">
                                                        <i class="fas fa-play"></i>
                                                    </div>
                                                </picture>
                                            </a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($events->isNotEmpty())
                            <div class="events">
                                <h2>{!! LangPart('events', 'EVENTS') !!}</h2>
                                <div class="row">
                                    @foreach($events as $event)
                                        @if($event->detail)
                                        <div class="col-lg-4 col-md-6">
                                            <a href="{!! strip_tags($event->detail->url) !!}">
                                                <picture>
                                                    <img data-src="assets/img/41.jpg" class="lazy" src="{!! image($event->f_) !!}"  alt="{!! $event->detail->name !!}">
                                                </picture>
                                                <b>{!! $event->detail->name !!}</b>

                                               <em>{!! \Carbon\Carbon::parse($event->created_at)->translatedFormat('j F Y') !!}</em>
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
