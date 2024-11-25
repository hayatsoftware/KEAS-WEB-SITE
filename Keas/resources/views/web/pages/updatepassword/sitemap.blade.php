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
                <div class="content" style="background-image: url('{!! image($sitemap->f_) !!}')">
                    <div class="club_content_white club_content_width">
                        <h1><img src="{!! image($sitemap->detail->f_) !!}" alt="KEAS Club"></h1>
                        <p>{!! LangPart('type_your_new_password', 'Type your new password') !!}</p>
                        @if ($errors->any())
                            <div class="alert alert-danger alertType">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form">
                            <form action="{!! Route('ResetPassword', ['lang'=>$mediapress->activeLanguage->code.'_'.$mediapress->activeCountryGroup->code]) !!}" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="token" value="{!! \Request::get('token') !!}" />
                                    {!! Form::hidden('next', getUrlBySitemapId(LOGIN_ST_ID)); !!}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password">{!! LangPart('your_new_password', 'Your New Password') !!} *</label>
                                            <input type="password" placeholder="{!! strip_tags(LangPart('password', 'Şifre')) !!}" autocomplete="new-password" name="password" pattern="^.{1,8,}$" id="password" minlength="8" maxlength="70" required>
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label id="password_confirmation">{!! LangPart('your_new_password_repeat', 'Repeat Your New Password') !!} *</label>
                                            <input type="password" placeholder="{!! strip_tags(LangPart('password_repeat', 'Şifre Tekrar')) !!}" autocomplete="new-password" name="password_confirmation" pattern="^.{1,8,}$" id="password_confirmation" minlength="8" maxlength="70" required>
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button class="button">{!! LangPart('reset_your_password_uppercase', 'RESET YOUR PASSWORD') !!}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
