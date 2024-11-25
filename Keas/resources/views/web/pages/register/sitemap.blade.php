@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $jobs = $mediapress->data['jobs'];
    $products = $mediapress->data['products'];
    $countries = $mediapress->data['countries'];
@endphp
@push('styles')
    <style>
        span.multiselect-native-select .btn-group{
            width: 100% !important;
        }
    </style>
@endpush
@section('content')

    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/intlTelInput.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/form.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/bootstrap-multiselect.min.css') !!}">

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
                <div class="content" style="background-image: url('{!! asset('assets/img/gorsel2.jpg') !!}')">
                    <div class="club_content_white">
                        <div class="row">
                            <div class="col-md-9">
                                <h1><img src="{!! asset('assets/img/club-logo.svg') !!}" alt="KEAS Club"></h1>
                            </div>
                            <div class="col-md-3 text-md-right">
                                <div class="back b-none"><a href="{!! getUrlBySitemapId(LOGIN_ST_ID) !!}">{!! LangPart('back', 'BACK') !!}</a></div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger alertType">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ strip_tags(LangPart(\Str::slug($error, '_'), $error)) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! $sitemap->detail->detail !!}
                        <div class="form">
                            <form action="{!! url('registerMe')!!}" method="POST" class="needs-validation" autocomplete="off" novalidate>
                                @csrf
                                {!! Form::hidden('next',getUrlBySitemapId(MY_ACCOUNT_ST_ID)) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{!! LangPart('first_name', 'First Name') !!} *</label>
                                            <input type="text" name="first_name" class="only-text" id="name" maxlength="50" required>
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">{!! LangPart('last_name', 'Surname') !!} *</label>
                                            <input type="text" name="last_name" id="last_name" class="only-text" maxlength="50" required >
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group phone_group">
                                            <label for="telefon">{!! LangPart('phone', 'Phone') !!} *</label>
                                            <input type="text" name="phone" class="telmask"  id="telefon" required>
                                            <input type="hidden" name="phone_country" value="TR">
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{!! LangPart('email', 'E-mail') !!} *</label>
                                            <input type="text" name="email"  class="" required id="email">
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meslek">{!! LangPart('job', 'Job') !!} *</label>
                                            <select id="meslek" name="job" required>
                                                <option value="">{!! strip_tags(LangPart('choose', 'Choose')) !!}</option>
                                                @foreach($jobs as $job)
                                                <option value="{!! $job->cint_1 !!}">{!! $job->detail->name !!}</option>
                                                @endforeach
                                            </select>
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group preferred_roducts">
                                            <label for="tercih">{!! LangPart('selected_products_register', 'Tercih Edilen Ürünler') !!} *</label>
                                            <select id="demo" name="products[]" multiple="multiple" tabindex="2" required style="display: none;">
                                                @foreach($products as $product)
                                                    <option value="{!! $product->crm_id !!}">{!! $product->name !!}</option>
                                                @endforeach
                                            </select>
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ulke">{!! LangPart('country', 'Country') !!} *</label>
                                            <select name="country" data-placeholder="{!! strip_tags(LangPart('country', 'Country')) !!}" class="chosen-select" tabindex="2" required>
                                                <option value=""></option>
                                                @foreach($countries as $country)
                                                    <option value="{!!  $country->tr !!}">{!! $mediapress->activeLanguage->code == 'tr' ? $country->tr :$country->en !!}</option>
                                                @endforeach
                                            </select>
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">{!! LangPart('city', 'Şehir') !!} *</label>
                                            <input type="text" name="city" id="city" class="only-text" maxlength="70" required>
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postakodu">{!! LangPart('zip_code', 'ZIP Code') !!}</label>
                                            <input type="number" name="zip_code" class="" maxlength="70" placeholder="{!! strip_tags(LangPart('zip_code', 'ZIP Code')) !!}" id="postakodu">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">{!! LangPart('password', 'Password') !!} *</label>
                                            <input autocomplete="new-password" type="password" class="form-control pass" id="password" name="password" pattern="(?=.*\d)(?=.*[A-z])(?=.*).{8,}" minlength="8" maxlength="70" required>
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires_password', 'Şifreniz en az 1 harf ve sayı olmak üzere minimum 8 karakterden oluşmalıdır.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password_confirmation">{!! LangPart('repeat_password', 'Şifre Tekrar') !!} *</label>

                                            <input autocomplete="new-password" type="password" class="form-control passAgain" id="password_confirmation" name="password_confirmation" pattern="(?=.*\d)(?=.*[A-z])(?=.*).{8,}" minlength="8" maxlength="70" required>


                                            <em class="invalid-feedback">{!! LangPart('not_equal_password', 'Şifreler eşleşmiyor') !!} </em>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="adres">{!! LangPart('address', 'Address') !!}</label>
                                            <textarea id="adres" name="address" maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="not"> {!! LangPart('required_fields_description', '* İşaretli alanların doldurulması zorunludur.') !!}</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="contact_text" id="iletisimizni" value="1" >
                                            <label class="form-check-label" for="iletisimizni">
                                                {!! LangPart('contact_text_description', ':a_tag_open İletişim İzin Metni :a_tag_close \'ni okudum, sms ve elektronik ileti gönderilmesini kabul ediyorum.', ['a_tag_open'=>'<a href="javascript:void(0)" data-src="#iletisim_izni" data-fancybox>','a_tag_close'=>'</a>']) !!}
                                            </label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="kvkk" type="checkbox" id="kvkk" value="1" required>
                                            <label class="form-check-label" for="kvkk">
                                                {!! LangPart('kvkk_text_description', ':a_tag_open KVKK Metni :a_tag_close \'ni okudum, kabul ediyorum.', ['a_tag_open'=>'<a href="javascript:void(0)" data-src="#kvkk_modal" data-fancybox>','a_tag_close'=>'</a>']) !!}
                                            </label>
                                            <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center mt-4 overflow-hidden">
                                        @if(config('services.recaptcha.key'))
                                            <div class="g-recaptcha"
                                                 data-sitekey="{{config('services.recaptcha.key')}}">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <input type="hidden" name="source" value="{!! $mediapress->data['device'] !!}" />
                                        <button type="submit" id="submitBtn" class="button">{!! LangPart('send', 'SEND') !!}</button>
                                    </div>

                                </div>
                                <div class="modal" id="iletisim_izni" style="display: none">
                                    <div class="inner">
                                        {!! $sitemap->detail->contact_text !!}
                                    </div>
                                </div>
                                <div class="modal" id="kvkk_modal" style="display: none">
                                    <div class="inner">
                                        {!! $sitemap->detail->kvkk !!}
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
@push('scripts')

    <script src="{!! asset('frontend/assets/js/form-script.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/intlTelInput.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/jquerymask.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/utils.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/bootstrap-multiselect.min.js') !!}"></script>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>

        $('#password, #password_confirmation').on('keyup', function () {
            if ($('#password').val() != '' && $('#password_confirmation').val() != '' && $('#password').val() == $('#password_confirmation').val()) {
                $("#submitBtn").attr("disabled",false);
                $('.passAgain').removeClass('is-invalid').css('borderColor','#198754');
            } else {
                $("#submitBtn").attr("disabled",true);
                $('.passAgain').addClass('is-invalid').css('borderColor','red');
            }
        });

        $(document).delegate( ".section .article form .form-group .multiselect", "click", function() {
            $('.multiselect-container').toggle()
        });

        $('*').click(function(e){
            if ( !$(e.target).is('.section .article form .form-group .multiselect') && !$(e.target).is('.section .article form .form-group .multiselect *') ){
                $('.multiselect-container').hide();
            }
        });
        $('#demo').multiselect({
            nonSelectedText: '{!! strip_tags(LangPart('choose', 'Seçiniz')) !!}'
        });


        var phoneScript = [];
        $.each($(".telmask"), function (key, value) {
            phoneScript.push(window.intlTelInput(value, {
                preferredCountries: ["tr"],
                separateDialCode: true,
                autoPlaceholder: "polite",
                customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                    return selectedCountryPlaceholder.replace(/[0-9]/g, "0");
                }
            }));
            var obj = $(value);

            obj.on("focus", function() {
                var activePlaceholder = obj.attr("placeholder");
                var newMask = activePlaceholder.replace(/[0-9]/g, "0");
                obj.mask(newMask);
            });
            var input = document.querySelector('.telmask');
            var iti = window.intlTelInputGlobals.getInstance(input);
            obj.on("countrychange", function () {
                var countryData = iti.getSelectedCountryData();
                $('input[name="phone_country"]').val(countryData.iso2.toUpperCase());
                obj.val("");
                obj.attr("maxlength", 20);
            });
        });


        function movePlus(){
            let objs = $(".telmask");
            $.each(objs, function (key, value) {
                obj = $(value);
                var flag = obj.closest(".iti--allow-dropdown").find("div.iti__selected-dial-code");
                if (obj.val().indexOf("+") == -1 && obj.val() !== "") {
                    obj.val(flag.text() + " " + obj.val());
                }
            });
        }

        $('form').on('submit',function(){
            movePlus();
        });

    </script>
@endpush
