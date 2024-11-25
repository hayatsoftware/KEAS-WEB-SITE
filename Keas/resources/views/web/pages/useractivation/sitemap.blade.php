@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
@endphp
@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/form.css') !!}">
    <style>

    </style>
    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! LangPart('account_activation', 'Account Activation') !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="content max_small text-center">
                    <div class="loader_spin">
                        <svg width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg" class="spinner">
                            <circle fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30" class="path"></circle>
                        </svg>
                        {!! LangPart('plaese_wait_sending', 'Gönderiliyor. Lütfen Bekleyiniz.') !!}
                    </div>
                    <h1>{!! LangPart('please_activate_your_account', 'Please Activate Your Account') !!}</h1>
                    <div class="tsk">
                        <form action="{!! route('verifyUser', ['cg'=>$mediapress->activeCountryGroup->code,'lg'=>$mediapress->activeLanguage->code]) !!}" method="POST">
                            @csrf
                            {!! Form::hidden('next',getUrlBySitemapId(MY_ACCOUNT_ST_ID)) !!}
                            <div class="form-group">
                                <input type="text" name="code" placeholder="{!! strip_tags(LangPart('please_type_four_digit_number', 'Please enter your 4 digit number')) !!}" maxlength="4"/>
                            </div>
                            <p>{!! LangPart('user_activation_description', 'We have sent your email activation code. Please enter your 4 digit activation number') !!}</p>
                            <p>{!! LangPart('user_activation_resend_description_new', 'If you didnt get any email form us, please :tag_open click here to resend activation :tag_close code your inbox. ', ['tag_open'=>'<a onClick="resendActivationCode()">','tag_close'=>'</a>']) !!}</p>
                            <input type="hidden" name="language_id" value="{!! $mediapress->activeLanguage->id !!}" />
                            <input type="hidden" name="country_id" value="{!! $mediapress->activeCountryGroup->id !!}" />
                            <button type="submit" class="button">{!! LangPart('activate', 'Activate') !!}</button>
                        </form>
                        <div class="errors">
                            <div class="alert alert-danger">
                                @if($errors->any())
                                    {{$errors->first()}}
                                @endif
                            </div>
                        </div>
                        <div class="success"></div>
                    </div>
                </div>

            </div>
        </article>
    </section>
@endsection
@push('scripts')
    <script>
        window.user_id = '{!! auth()->user()->id !!}';
        window.country_id = '{!! $mediapress->activeCountryGroup->id !!}';
        window.language_id = '{!! $mediapress->activeLanguage->id !!}';
        function resendActivationCode(){
            $('.success').html("");
            $('.errors').html("");
            $('.loader_spin').show();
            $.ajax({
                url: '{!! route('resendActivationCode') !!}',
                method:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    language_id:window.language_id,
                    country_group_id:window.country_id,
                    user_id:window.user_id
                },
                dataType:'json',
                success:function(res){
                    if(res.status == 1){
                        $('.success').append('<span>'+res.msg+'</span>');
                    }else{
                        $('.errors').append('<span>'+res.msg+'</span>');
                    }
                    $('.loader_spin').hide();
                }
            })
        }
    </script>
@endpush
