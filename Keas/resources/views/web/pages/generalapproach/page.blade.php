@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $page = $mediapress->data['page'];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/general-approach.css') !!}">
    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="{!! getUrlBySitemapId(50) !!}">{!! LangPart('human', 'Human') !!} </a></li>
                    <li><a href="{!! strip_tags($page->detail->url) !!}">{!! $page->detail->name !!}</a></li>
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
                            <h1>{!! $page->detail->name !!}</h1>
                            {!! do_shortcode($page->detail->detail) !!}
                            <div class="join-team">
                                <h2>{!! LangPart('join_keas_team', 'Join Keas Team') !!}</h2>
                                <p>{!! LangPart('join_keas_team_text', 'Kastamonu Entegre’de yer almak isterseniz Kariyer.net ve Linkedin şirket sayfalarımızdan aktif iş ilanlarımızı takip edebilir ya da cv’nizi
                                    <a href="mailto:kariyer@keas.com.tr" style="color:#008F4A;">kariyer@keas.com.tr</a> mail
                                    adresine gönderebilirsiniz.') !!}</p>
                                <nav>
                                    <!--<a href="https://career012.successfactors.eu/career?company=hayatkimyaP&site=VjItSWREblprRW9JOEpQZ0JsU0NoVDVSdz09" target="_blank" class="btn1">{!! LangPart('join_keas_team_url_text', 'İŞ BAŞVURUSU') !!}</a>!-->
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
