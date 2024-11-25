@extends('web.inc.app')

@php
    $sitemap = $mediapress->data['sitemap'];
    $pages = $mediapress->data['pages'] ?? [];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/general-approach.css') !!}">
    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('human', 'Human') !!} </a></li>
                    <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! $sitemap->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar">
                            @include('web.inc.approach-menu')
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="content">
                            <h1>{!! $sitemap->detail->name !!}</h1>
                            {!! do_shortcode($sitemap->detail->detail) !!}
                            @foreach( $pages as $page )
                                <div class="list">
                                    <h2>{!! $page->detail->name !!}</h2>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>{!! $page->detail->detail ? \Str::limit(strip_tags($page->detail->detail), 400) : "" !!}</p>
                                            <a href="{!! $page->detail->url !!}" class="more">{!! LangPart('more', 'More') !!}</a>
                                        </div>
                                        <div class="col-lg-6">
                                            <figure>
                                                <img data-src="{!! strip_tags(image($page->f_)) !!}" class="lazy" src="{!! strip_tags(image($page->f_)) !!}" alt="{!! strip_tags(image($page->detail->name)) !!}">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="join-team">
                                <h2>{!! LangPart('join_keas_team', 'Join Keas Team') !!}</h2>
                                <p>{!! LangPart('join_keas_team_text', 'Kastamonu Entegre’de yer almak isterseniz Kariyer.net ve Linkedin şirket sayfalarımızdan aktif iş ilanlarımızı takip edebilir ya da cv’nizi
                                    <a href="mailto:kariyer@keas.com.tr" style="color:#008F4A;">kariyer@keas.com.tr</a> mail
                                    adresine gönderebilirsiniz.') !!}</p>
                                <nav>
                                    <a href="{!! getUrlBySitemapId(KVKK_ST_ID) !!}" class="btn2">{!! LangPart('kvkk_text', 'KVKK METNİ') !!}</a>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
@push('scripts')
    <script src="{!! asset('frontend/assets/js/pageside.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/inovasyon.js') !!}"></script>

@endpush
