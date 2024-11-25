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
                    <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! $sitemap->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="login_sidebar">
                            <div class="side">
                                <div class="head">{!! LangPart('password_remember', 'Şifre Hatırlatma') !!}</div>
                                @if( Session::has('error'))
                                    <div class="alert alert-danger alertType">
                                        <ul>
                                            <li>{!! session('error') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                @if( Session::has('success'))
                                    <div class="alert alert-success alertType">
                                        <ul>
                                            <li>{!! session('success') !!}</li>
                                        </ul>
                                    </div>
                                    <a href="{!! getUrlBySitemapId(LOGIN_ST_ID) !!}" class="forgot-password">{!! LangPart('sign_in','Sign In') !!}</a>
                                @else
                                    <form action="{!! Route('validatePasswordReset', ['cg' => $mediapress->activeCountryGroup->code, 'lg'=>$mediapress->activeLanguage->code]) !!}" method="POST">
                                        @csrf
                                        {!! Form::hidden('next', getUrlBySitemapId(RESET_PASSWORD_ST_ID)) !!}
                                        {!! Form::hidden('cg', $mediapress->activeCountryGroup->id) !!}
                                        {!! Form::hidden('lg', $mediapress->activeLanguage->id) !!}
                                        <div class="form-group">
                                            <label for="email">{!! LangPart('email', 'E-mail') !!} *</label>
                                            <input type="email" name="email" class="" required id="email" maxlength="70">
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>

                                        <div class="form-group  text-center">
                                            <button class="button">{!! LangPart('send_password', 'ŞİFRE GÖNDER') !!}</button>
                                            <a href="{!! getUrlBySitemapId(LOGIN_ST_ID) !!}" class="forgot-password">{!! LangPart('sign_in','Sign In') !!}</a>
                                        </div>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="content" style="background-image: url('{!! image($sitemap->f_) !!}')">
                            <div class="club_content">
                                <h1><img src="{!! image($sitemap->detail->f_) !!}" alt=""></h1>
                                <div class="text">
                                    {!! $sitemap->detail->detail !!}
                                </div>
                                <a href="{!! getUrlBySitemapId(REGISTER_ST_ID) !!}" class="supplier">{!! LangPart('register_now', 'REGISTER NOW') !!}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </article>
    </section>
@endsection
