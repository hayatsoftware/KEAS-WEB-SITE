@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $countries = $mediapress->data['countries'];
    $subjects = $mediapress->data['subjects'];
    $offices = $mediapress->data['offices'];
    $domestic_offices = $mediapress->data['domestic_offices'];
    $abroad_offices = $mediapress->data['abroad_offices'];
    $formVariables = $mediapress->data['formVariables'];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/intlTelInput.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/facilities.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/contact.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/form.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('contact', 'Contact') !!}</a></li>
                    <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! $sitemap->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        @if (count($errors) > 0)
            <article class="article">
                <div class="content max_small text-center">
                <h1>HATA!.</h1>
                    <div class="tsk">
                        <div class="icons01"><img src="{!! asset('assets/img/error.svg') !!}" alt=""></div>
                        {!! LangPart('contact_form_couldnt_send', 'Form gönderilemedi.') !!}</br>
                        @if($errors->count() > 0)
                            @foreach ($errors->all() as $key=>$error)
                                {{ $error }}</br>
                            @endforeach
                        @endif
                        {!! LangPart('contact_form_couldnt_send_line_two', 'Form sayfasına dönerek göndermeyi yeniden deneyebilirsiniz.') !!}</br>
                        <a href="{!! getUrlBySitemapId(CONTACT_ST_ID) !!}" class="more mt-4">{!! LangPart('contact_form', 'Contact Form') !!}</a>
                    </div>
                </div>
            </article>
        @elseif( \Request::get('success') )
            <article class="article">
                <div class="content max_small text-center">
                    <h1>{!! LangPart('thank_you', 'THANK YOU') !!}.</h1>
                    <div class="tsk">
                        <div class="icons01"><img src="{!! asset('assets/img/circle.svg') !!}" alt=""></div>
                        {!! LangPart('thank_you_description', 'Formunuzu başarıyla aldık. <br>Talep ettiğiniz konuyla ilgili ekibimiz en kısa sürede<br>size dönüş yapacaktır.') !!}
                    </div>
                </div>
            </article>
        @else
            <article class="article">
                <div class="container-fluid">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="sidebar_contact">
                                    <ul>
                                        @if($mediapress->activeCountryGroup->code != 'ru' && $mediapress->activeCountryGroup->code != 'rg')
                                        <li ><a href="#iletisim-formu">{!! LangPart('contact_form', 'İletişim Formu') !!}</a></li>
                                        @endif
                                        <li><a href="#keas-ofisleri">{!! LangPart('keas_offices', 'Keas Ofisleri') !!}</a></li>
                                        <li><a href="#yurtici-ofisler">{!! LangPart('domestic_offices', 'Yurtiçi Tesisler') !!}</a></li>
                                        <li><a href="#yurtdisi-sirketler">{!! LangPart('nondomestic_offices', 'Yurtdışı Şirketler') !!}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                @if($mediapress->activeCountryGroup->code != 'ru' && $mediapress->activeCountryGroup->code != 'rg')
                                <div id="iletisim-formu" class="group">
                                    <div class="form">
                                        <h1>{!! $sitemap->detail->name !!}</h1>

                                        <form action="{!! url("/form/store") !!}" method="post" enctype="multipart/form-data">
                                            @if( isset($formVariables) && isset( $formVariables["hidden"] ) )
                                                {!! $formVariables["hidden"] !!}
                                            @endif
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="isim">{!! LangPart('first_name', 'İsim') !!}</label>
                                                        <input type="text" name="name" class="only-text" id="first_name" maxlength="50" value="{{ old('name')  }}">
                                                        <!--<em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>!-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="soyisim">{!! LangPart('surname', 'Soyisim') !!}</label>
                                                        <input type="text" name="surname" id="soyisim" class="only-text" maxlength="50">
                                                        <!--<em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>!-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="telefon">{!! LangPart('phone', 'Telefon') !!}</label>
                                                        <input type="text" name="phone" class="telmask" id="telefon">
                                                        <!--<em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>!-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">{!! LangPart('email', 'E-posta') !!}</label>
                                                        <input type="text" name="email" class=""  id="email" maxlength="50">
                                                        <!--<em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>!-->
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="ulke">{!! LangPart('country', 'Ülke') !!} *</label>
                                                        <select data-placeholder="{!! strip_tags(LangPart('country', 'Ülke')) !!}" name="country" class="chosen-select" tabindex="2">
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
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="konu">{!! LangPart('subject', 'Konu') !!} *</label>
                                                        <select name="subject">
                                                            <option value="">{!! LangPart('choose', 'Choose') !!}</option>
                                                            @foreach($subjects as $subject)
                                                                <option value="{!! $subject->cint_1 !!}">{!! $subject->detail->name !!}</option>
                                                            @endforeach
                                                        </select>
                                                        <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="aciklama">{!! LangPart('your_message', 'Your Message') !!}</label>
                                                        <textarea id="aciklama" name="message" maxlength="1000"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="not"> {!! LangPart('required_fields_description', '* İşaretli alanların doldurulması zorunludur.') !!}</div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="contact_text" id="iletisimizni" value="1">
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
                                                <div class="col-md-12 text-center mt-4">
                                                    @if(config('services.recaptcha.key'))
                                                        <div class="g-recaptcha"
                                                             data-sitekey="{{config('services.recaptcha.key')}}">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 text-center mt-4">
                                                    <input type="hidden" name="source" value="{!! $mediapress->data['device'] !!}" />
                                                    <input type="hidden" name="country_group_id" value="{!! $mediapress->activeCountryGroup->id !!}" />
                                                    <input type="hidden" name="language_id" value="{!! $mediapress->activeLanguage->id !!}" />
                                                    <button class="button">{!! LangPart('send', 'SEND') !!}</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="modal" id="iletisim_izni" style="display: none">
                                            <div class="inner">{!! $sitemap->detail->contact_text !!}</div>
                                        </div>
                                        <div class="modal" id="kvkk_modal" style="display: none">
                                            <div class="inner">{!! $sitemap->detail->kvkk_text !!}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if( $offices->isNotEmpty() )
                                    @include('web.pages.contactus.offices', ['offices'=>$offices, 'title'=> LangPart('keas_offices', 'KEAS OFFICES'), 'id'=>'keas-ofisleri'])
                                @endif
                                @if($domestic_offices->isNotEmpty())
                                    @include('web.pages.contactus.offices', ['offices'=>$domestic_offices, 'title'=> LangPart('keas_domestic_offices', 'KEAS DOMESTIC OFFICES'), 'id'=>'yurtici-ofisler'])
                                @endif
                                @if($abroad_offices->isNotEmpty())
                                    @include('web.pages.contactus.offices', ['offices'=>$abroad_offices, 'title'=> LangPart('keas_abroad_offices', 'KEAS ABROAD OFFICES'), 'id'=>'yurtdisi-sirketler'])
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </article>
        @endif

    </section>
@endsection
@push('scripts')
    <script src="{!! asset('frontend/assets/js/intlTelInput.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/jquerymask.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/utils.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/form-script.js') !!}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>

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

            obj.on("countrychange", function (e, countryData) {
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
            var firstNameInput = document.getElementById('first_name');
            if (firstNameInput.value.trim() === '') {
                firstNameInput.value = 'Anonim';
            }

            var lastNameInput = document.getElementById('soyisim');
            if (lastNameInput.value.trim() === '') {
                lastNameInput.value = 'Anonim';
            }

            var telefonInput = document.getElementById('telefon');
            if (telefonInput.value.trim() === '') {
                telefonInput.value = '+90555 555 55 55';
            }

            var emailInput = document.getElementById('email');
            if (emailInput.value.trim() === '') {
                emailInput.value = 'anonim@keas.com.tr';
            }
            movePlus();
        });

    </script>
@endpush
