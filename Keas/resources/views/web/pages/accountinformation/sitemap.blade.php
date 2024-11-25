@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $jobs = $mediapress->data['jobs'];
    $products = $mediapress->data['products'];
    $countries = $mediapress->data['countries'];
    $user = $mediapress->data['user'];
    $registerSitemap = \Mediapress\Modules\Content\Models\Sitemap::find(REGISTER_ST_ID);
    $lg = $mediapress->activeLanguage->code;
@endphp

@section('content')

    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/intlTelInput.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/bootstrap-multiselect.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/form.css') !!}">


    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('keas_club', 'Keas Club') !!}</a></li>
                    <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! $sitemap->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        @include('web.inc.login-sidebar')
                    </div>
                    <div class="col-lg-9">
                        <div class="content" style="background-image: url('{!! image($sitemap->f_) !!}')">
                            <div class="login_content">
                                <h1>{!! $sitemap->detail->name !!}</h1>
                                @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{!! LangPart('profile_update_success', 'Your account information successfully updated.') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger alertType">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ strip_tags(LangPart(\Str::slug($error, '_'), $error)) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form">
                                    <form action="{!! route('updateProfile') !!}" method="POST">
                                        @csrf
                                        {!! Form::hidden('next',url(strip_tags($sitemap->detail->url))) !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">{!! LangPart('first_name', 'First Name') !!} *</label>
                                                    <input type="text" name="first_name" class="only-text" id="name" value="{!! $user->first_name !!}" maxlength="50" required>
                                                    <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name">{!! LangPart('last_name', 'Surname') !!} *</label>
                                                    <input type="text" name="last_name" id="last_name" value="{!! $user->last_name !!}" class="only-text" maxlength="50" required >
                                                    <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefon">{!! LangPart('phone', 'Phone') !!} *</label>
                                                    <input type="text" name="phone" class="telmask" value="{!! $user->phone !!}" id="telefon">
                                                    <input type="hidden" name="phone_country" value="{{@$user->data['phone_country']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">{!! LangPart('email', 'E-mail') !!} *</label>
                                                    <input type="email" name="email" class="" id="email" value="{!! $user->email !!}" maxlength="70" required readonly>
                                                    <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meslek">{!! LangPart('job', 'Job') !!} *</label>
                                                    <select id="meslek" name="job">
                                                        @foreach($jobs as $job)
                                                            <option value="{!! $job->cint_1 !!}" {!! $job->cint_1 == $user->data['job'] ? 'selected':'' !!}>{!! $job->detail->name !!}</option>
                                                        @endforeach
                                                    </select>
                                                    <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tercih">{!! LangPart('selected_products_register', 'Tercih Edilen Ürünler') !!} *</label>
                                                    <select id="demo" name="products[]" multiple="multiple">
                                                        @foreach($products as $product)
                                                            <option value="{!! $product->crm_id !!}" {!! in_array($product->crm_id, $user->data['products']) ? 'selected':'' !!}>{!! $product->name !!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ulke">{!! LangPart('country', 'Country') !!} *</label>
                                                    <select name="country" data-placeholder="{!! strip_tags(LangPart('country', 'Country')) !!}" class="chosen-select" tabindex="2">
                                                        <option value=""></option>
                                                        @foreach($countries as $country)
                                                            @php
                                                                $countryName = $lg == 'tr' ? $country->tr : $country->en;
                                                            @endphp
                                                            <option value="{!!  $country->tr !!}" {!! $country->tr == $user->data['country'] ? 'selected':'' !!}>{!! $countryName !!}</option>
                                                        @endforeach
                                                    </select>
                                                    <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="city">{!! LangPart('city', 'Şehir') !!} *</label>
                                                    <input type="text" name="city" id="city" class="only-text" value="{!! $user->data['city'] !!}" maxlength="70" required>
                                                    <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="postakodu">{!! LangPart('zip_code', 'ZIP Code') !!}</label>
                                                    <input type="number" name="zip_code" class="" value="{!! $user->data['zip_code'] !!}" maxlength="70" placeholder="{!! strip_tags(LangPart('zip_code', 'ZIP Code')) !!}" id="postakodu">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="password">{!! LangPart('password', 'Password') !!} *</label>
                                                    <input autocomplete="new-password" type="password" class="form-control pass" id="password" name="password" pattern="(?=.*\d)(?=.*[A-z])(?=.*).{8,}" minlength="8" maxlength="70" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="password_confirmation">{!! LangPart('repeat_password', 'Şifre Tekrar') !!} *</label>

                                                    <input autocomplete="new-password" type="password" class="form-control passAgain" id="password_confirmation" name="password_confirmation" pattern="(?=.*\d)(?=.*[A-z])(?=.*).{8,}" minlength="8" maxlength="70" >

                                                    <em class="invalid-feedback">{!! LangPart('not_equal_password', 'Şifreler eşleşmiyor') !!} </em>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="adres">{!! LangPart('address', 'Address') !!}</label>
                                                    <textarea id="adres" name="address" maxlength="1000">{!! $user->data['address'] !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="not"> {!! LangPart('required_fields_description', '* İşaretli alanların doldurulması zorunludur.') !!}</div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="contact_text" id="iletisimizni" value="1" {!! $user->is_sms == 1 ? 'checked':'' !!}>
                                                    <label class="form-check-label" for="iletisimizni">
                                                        {!! LangPart('contact_text_description', ':a_tag_open İletişim İzin Metni :a_tag_close \'ni okudum, sms ve elektronik ileti gönderilmesini kabul ediyorum.', ['a_tag_open'=>'<a href="javascript:void(0)" data-src="#iletisim_izni" data-fancybox>','a_tag_close'=>'</a>']) !!}
                                                    </label>
                                                    <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" name="kvkk" type="checkbox" id="kvkk" value="1" {!! $user->is_kvkk == 1 ? 'checked':'' !!}>
                                                    <label class="form-check-label" for="kvkk">
                                                        {!! LangPart('kvkk_text_description', ':a_tag_open KVKK Metni :a_tag_close \'ni okudum, kabul ediyorum.', ['a_tag_open'=>'<a href="javascript:void(0)" data-src="#kvkk_modal" data-fancybox>','a_tag_close'=>'</a>']) !!}
                                                    </label>
                                                    <em class="invalid-feedback">{!! LangPart('this_field_is_requires', 'Bu alan zorunludur.') !!} </em>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="button mt-5" id="submitBtn">{!! LangPart('send', 'SEND') !!}</button>
                                            </div>
                                        </div>
                                        <div class="modal" id="iletisim_izni" style="display: none">
                                            <div class="inner">
                                                {!! $registerSitemap->detail->contact_text !!}
                                            </div>
                                        </div>
                                        <div class="modal" id="kvkk_modal" style="display: none">
                                            <div class="inner">
                                                {!! $registerSitemap->detail->kvkk !!}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </article>
    </section>
@endsection
@push('scripts')

    <script src="{!! asset('frontend/assets/js/intlTelInput.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/jquerymask.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/utils.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/bootstrap-multiselect.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/form-script.js') !!}"></script>
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
            nonSelectedText: 'Seçiniz'
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

