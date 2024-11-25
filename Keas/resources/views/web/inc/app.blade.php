@extends('mediapress::main')
@push('styles')




    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{!! settingSun('logo.favicon') ?
                                image(settingSun('logo.favicon')) :
                                asset('vendor/mediapress/images/logo-m.jpg') !!}" />
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/newCookie.css') !!}" />
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/jqueryfancybox.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/chosen.css') !!}" />
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/select2.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/bootstrap.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/nice-select.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/grid.css') !!}" />
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/header.css?v=01') !!}" />
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/footer.css?v=05') !!}" />
@endpush
@include("web.inc.header")
@include("web.inc.footer")
@prepend('scripts')
    @stack('pre_scripts')
    <style>
        .change_lang.disabled{
            pointer-events: none;
            opacity: .5;
            cursor: default;
        }
    </style>
    <script>
        window.activeLanguage = '{!! $mediapress->activeLanguage->code !!}';
        window.activeCountry = '{!! $mediapress->activeCountryGroup->code !!}';
        window.activeLanguageId = '{!! $mediapress->activeLanguage->id !!}';
        window.activeCountryId = '{!! $mediapress->activeCountryGroup->id !!}';
    </script>

    <script src="{!! asset('frontend/assets/js/jquery.min.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/jquerytextillate.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/jquerylettering.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/jqueryfancybox.min.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/cookieconsent.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/chosenjquery.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/jquerynice-select.min.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/lazyload.min.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/valid.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/select2.min.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/jqueryinputmaskbundle.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/keas.js?v=01') !!}"></script>
    <script src="{{ asset('/js/app.js?v=1.19') }}"></script>
    <script>

      /*  $('#submitEBulten').click(function () {
            $('.loader_footer').show();
        })*/

      document.addEventListener('DOMContentLoaded', function () {
          cookieconsent.run({"notice_banner_type":"simple","consent_type":"express","palette":"dark","language":"tr","page_load_consent_levels":["strictly-necessary"],"notice_banner_reject_button_hide":false,"preferences_center_close_button_hide":false,"page_refresh_confirmation_buttons":false,"website_name":"MC","website_privacy_policy_url":"/tr_tr/sayfa/cerezlere-iliskin-aydinlatma-metni"});
      });


        </script>


    <script type="text/plain" cookie-consent="tracking">
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KMFQTN2');
    </script>




    <script>

        $(document).ready(function(){



            $('.chosen-select').chosen({
                no_results_text: "{!! strip_tags(LangPart('no_results_text', 'Herhangi bir öğe bulunamadı.')) !!}",
            });
            $('#ulke,#ulke_chosen').on('change', function(){
                $('select.change_lang').html("");
                let country_group = $(this).val();
                let zone = $('#ulke').find(":selected").attr("data-country");
                $('#langSelect').removeClass('disabled');

                window.activeCountry = zone;
                $.ajax({
                    url: '{!! route('getLanguagesOfSelectedZone') !!}',
                    type:'POST',
                    data:{
                        country_group:country_group
                    },
                    dataType:'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(res){
                        if( res.length ){
                            for( let i = 0; i < res.length; i++ ){
                                $('select.change_lang').append('<option value="'+res[i].slug+'">'+res[i].name+'</option>');
                            }
                            $('select.change_lang').niceSelect('update');
                        }
                    }
                });
            });
            $('#eBultenForm').on('submit', function(e){
                e.preventDefault();
                $('#hata_modal span.error_message').html("");
                let formData = new FormData($(this)[0]);
                $('.loader_footer').show();
                $.ajax({
                    url:'{!! route('Subscription') !!}',
                    type:'POST',
                    processData: false,
                    contentType: false,
                    data:formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(res){
                        if(res.status){
                            $('#thanks_modal_open').trigger('click');
                            $('.loader_footer').hide();
                        }else{
                            $('#hata_modal span.error_message').text(res.msg);
                            $('#error_modal_open').trigger('click');
                            $('.loader_footer').hide();
                        }
                    },
                    error: function (error) {
                        let errorResponse = error.responseJSON.errors;
                        let errorData = [];
                        for(let error in errorResponse){
                            for( var i = 0; i < errorResponse[error].length; i++ ){
                                errorData.push(errorResponse[error][i]);
                            }
                        }
                        $('#hata_modal span.error_message').text(errorData[0]);
                        $('#error_modal_open').trigger('click');
                        $('.loader_footer').hide();
                    }
                });
                return false;
            });
        });
        var changeLanguage = function(){
            let lang = $('select.change_lang').val();
            let country_group = $('#ulke').find(":selected").attr("data-country");
            let country = $('#ulke').find(":selected").val();
            $.ajax({
                url:'{!! route('setCountryGroupAndLanguage') !!}',
                type:'POST',
                data:{
                    country_group:country_group,
                    language:lang,
                    country:country
                },
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(res){
                    window.location.href = res.url;
                    $('.language-wrap .language-box .selects button').addClass('disabled').attr('disabled', 'disabled');
                }
            });
        }
        $(document).delegate(".cc-nb-okagree", "click", function(){
            $('input[name=functionality]').prop("checked", true);
            $('input[name=tracking]').prop("checked", true);
            $('input[name=targeting]').prop("checked", true);

            $('#title_functionality').parent().remove();
            $('#title_functionality').remove();

        });

        $(document).delegate(".cc-cp-foot-save", "click", function(){
            $('input[name=functionality]').prop("checked", true);
            $('input[name=tracking]').prop("checked", true);
            $('input[name=targeting]').prop("checked", true);
            $('.cc-nb-okagree').trigger('click');
        });

        $(document).delegate(".cc-nb-changep", "click", function(){

            setTimeout(function (){
                $('#tracking_label').text('{{ strip_tags(langPartAttr('cookieActiveText', " Etkin")) }}');
                $('#targeting_label').text('{{ strip_tags(langPartAttr('cookieActiveText', " Etkin")) }}');
            },100);


            $('input[name=functionality]').prop("checked", true);
            $('input[name=tracking]').prop("checked", true);
            $('input[name=targeting]').prop("checked", true);
            $('#title_functionality').parent().remove();
            $('#title_functionality').remove();
            $('#title_more_information').parent().remove();
            $('#content_more_information').remove();

            $('input[name=functionality]').change(function (){
                if (this.checked) {
                    $('input[name=functionality]').prop("checked", true);
                    $('#functionality_label').text('{{ strip_tags(langPartAttr('cookieActiveText', " Etkin")) }}');
                }
                else{
                    $('input[name=functionality]').prop("checked", false);
                    $('#functionality_label').text('{{ strip_tags(langPartAttr('cookieActiveNoneText', " Etkin Değil")) }}');
                }
            });
            $('#functionality_label').text('{{ strip_tags(langPartAttr('cookieActiveNoneText', " Etkin Değil")) }}');


            $('input[name=tracking]').change(function (){
                if (this.checked) {
                    $('input[name=tracking]').prop("checked", true);
                    $('#tracking_label').text('{{ strip_tags(langPartAttr('cookieActiveText', " Etkin")) }}');
                }
                else{
                    $('input[name=tracking]').prop("checked", false);
                    $('#tracking_label').text('{{ strip_tags(langPartAttr('cookieActiveNoneText', " Etkin Değil")) }}');
                }
            });
            $('#tracking_label').text('{{ strip_tags(langPartAttr('cookieActiveNoneText', " Etkin Değil")) }}');

            $('input[name=targeting]').change(function (){
                if (this.checked) {
                    $('input[name=targeting]').prop("checked", true);
                    $('#targeting_label').text('{{ strip_tags(langPartAttr('cookieActiveText', " Etkin")) }}');
                }
                else{
                    $('input[name=targeting]').prop("checked", false);
                    $('#targeting_label').text('{{ strip_tags(langPartAttr('cookieActiveNoneText', " Etkin Değil")) }}');
                }
            });
            $('#targeting_label').text('{{ strip_tags(langPartAttr('cookieActiveNoneText', " Etkin Değil")) }}');

            $('#cc-pc-head-title-headline').text('{{ strip_tags(langPartAttr('cookieCenter', " Çerez Tercihleri Merkezi")) }}');
            $('.cc-cp-foot-save').text('{{ strip_tags(langPartAttr('cookieSavePreferences', " Tercihleri Kaydet")) }}');

            $('.cc-cp-foot-byline').remove();


            $('#title_your_privacy').text('{{ strip_tags(langPartAttr('cookiePrivacyTitle', " Gizliliğiniz")) }}');
            $('#title_strictly-necessary').text('{{ strip_tags(langPartAttr('cookieRequieredTitle', " Zorunlu Çerezler")) }}');
            $('#title_functionality').text('{{ strip_tags(langPartAttr('cookieFunctionalTitle', " İşlevsel Çerezler")) }}');
            $('#title_tracking').text('{{ strip_tags(langPartAttr('cookiePerformanceTitle', " Performans Çerezleri")) }}');
            $('#title_targeting').text('{{ strip_tags(langPartAttr('cookieAdvertisingTitle', " Reklam/Pazarlama Çerezleri")) }}');

            $('#content_your_privacy .cc-cp-body-content-entry-title').text('{{ strip_tags(langPartAttr('cookiePrivacyTitle', " Gizliliğiniz")) }}');
            $('#content_your_privacy .cc-cp-body-content-entry-text').hide();
            $('#content_your_privacy .cc-cp-body-content-entry-text:nth-child(2)').show();
            $('#content_your_privacy .cc-cp-body-content-entry-text').text('');
            $('#content_your_privacy .cc-cp-body-content-entry-text').html('<a style="text-decoration:none !important;" href="{{ strip_tags(langPartAttr('cookieTextNewLink', " Çerez Politikası Link")) }}">{{ strip_tags(langPartAttr('cookieText', " Çerez Politikası")) }}</a>');

            $('#content_strictly-necessary .cc-cp-body-content-entry-title').text('{{ strip_tags(langPartAttr('cookieRequieredTitle', " Zorunlu Çerezler")) }}');
            $('#content_strictly-necessary .cc-cp-body-content-entry-text').hide();
            $('#content_strictly-necessary .cc-cp-body-content-entry-text:nth-child(2)').show();
            $('#content_strictly-necessary .cc-cp-body-content-entry-text').text('{{ strip_tags(langPartAttr('cookieRequieredContent', " Zorunlu Çerezler")) }}');
            $('#content_strictly-necessary #strictly-necessary_label').text('{{ strip_tags(langPartAttr('cookieAllActive', " Her zaman etkin")) }}');

            $('#content_functionality .cc-cp-body-content-entry-title').text('{{ strip_tags(langPartAttr('cookieFunctionalTitle', " İşlevsel Çerezler")) }}');
            $('#content_functionality .cc-cp-body-content-entry-text').hide();
            $('#content_functionality .cc-cp-body-content-entry-text:nth-child(2)').show();
            $('#content_functionality .cc-cp-body-content-entry-text').text('{{ strip_tags(langPartAttr('cookieFunctionalContent', " İşlevsel Çerezler")) }}');

            $('#content_tracking .cc-cp-body-content-entry-title').text('{{ strip_tags(langPartAttr('cookiePerformanceTitle', " Performans Çerezleri")) }}');
            $('#content_tracking .cc-cp-body-content-entry-text').hide();
            $('#content_tracking .cc-cp-body-content-entry-text:nth-child(2)').show();
            $('#content_tracking .cc-cp-body-content-entry-text').text('{{ strip_tags(langPartAttr('cookiePerformanceContent', " Performans Çerezleri")) }}');

            $('#content_targeting .cc-cp-body-content-entry-title').text('{{ strip_tags(langPartAttr('cookieAdvertisingTitle', " Reklam/Pazarlama Çerezleri")) }}');
            $('#content_targeting .cc-cp-body-content-entry-text').hide();
            $('#content_targeting .cc-cp-body-content-entry-text:nth-child(2)').show();
            $('#content_targeting .cc-cp-body-content-entry-text').text('{{ strip_tags(langPartAttr('cookieAdvertisingContent', " Reklam/Pazarlama Çerezleri")) }}');


        });

        setTimeout(function (){
            $('#cc-nb-title').text('çerez başlık');
            $('#cc-nb-text').text('');
            $('#cc-nb-text').html('<a href="{!! strip_tags(LangPart('cookieTextNewLink', 'Çerez Politikası Link')) !!}">{!! strip_tags(LangPart('cookieText', 'Çerez Politikası')) !!}</a>');

            $('.cc-nb-okagree').text('{{ strip_tags(langPartAttr('cookieAllChecks', " Tümünü Kabul Et")) }}');
            $('.cc-nb-reject').text('{{ strip_tags(langPartAttr('cookieAllNone', " Tümünü Reddet")) }}');
            $('.cc-nb-changep').text('{{ strip_tags(langPartAttr('cookieOptions', " Çerez Ayarları")) }}');
        },200);
    </script>
@endprepend
