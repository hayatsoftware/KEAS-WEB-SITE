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
                            <div class="club_logo">
                                <img src="{!! asset('assets/img/club.svg') !!}" >
                            </div>
                            <div class="side">
                                <div class="head">{!! LangPart('user_login', 'User Login') !!}</div>
                                @if ($errors->any())
                                    @error('throttle_error')
                                    <div class="alert alert-danger alertType">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                    @else
                                    <div class="alert alert-danger alertType">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ strip_tags(LangPart(\Str::slug($error, '_'), $error)) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @enderror

                                @endif
                                @if (\Session::has('reset_password_success'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{!! LangPart('reset_password_success_message', 'Your password has been updated successfully.') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                <form action="{!! url('loginMe')!!}" method="post" autocomplete="off">
                                    @csrf
                                    {!! Form::hidden('next', $next ?? getUrlBySitemapId(MY_ACCOUNT_ST_ID)); !!}
                                    {!! Form::hidden('cg', $mediapress->activeCountryGroup->id); !!}
                                    {!! Form::hidden('lg', $mediapress->activeLanguage->id); !!}
                                    <div class="form-group">
                                        <label for="email">{!! LangPart('email', 'E-mail') !!} *</label>
                                        <input type="email" name="email" class="" required id="email" maxlength="70">
                                        <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{!! LangPart('password', 'Password') !!} *</label>
                                        <input type="password" class="" required placeholder="{!! strip_tags(LangPart('password', 'Password')) !!}" autocomplete="new-password" name="password" pattern="^.{1,8,}$" minlength="8" maxlength="70" id="password">
                                        <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="button">{!! LangPart('sign_in', 'Sign In') !!}</button>
                                        <a href="{!! getUrlBySitemapId(FORGOT_MY_PASSWORD) !!}" class="forgot-password">{!! LangPart('forgot_my_password', 'Forgot my password') !!}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="content" style="background-image: url('{!! image($sitemap->f_) !!}')">
                            <div class="club_content">
                                <h1><img src="{!! image($sitemap->detail->f_) !!}" alt="Login"></h1>
                                <div class="text">
                                    {!! $sitemap->detail->detail !!}
                                </div>
                                <a href="{!! getUrlBySitemapId(REGISTER_ST_ID) !!}" class="supplier">{!! LangPart('register_now', 'REGISTER NOW') !!}</a>
                                <a href="{!! getUrlBySitemapId(KEAS_CLUB_ST_ID) !!}" class="supplier">{!! LangPart('about_keas_club', 'Keas Club Hakkında') !!}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </article>
    </section>
@endsection
