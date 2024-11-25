@php
    $footer_menu = Cache::remember('footer_menu_'.$mediapress->activeLanguage->code.'_'.$mediapress->activeCountryGroup->code, 7*24*60*60, function()use($mediapress){
        return $mediapress->menu('footer-menu');
    });
    $copyright_menu = Cache::remember('copyright_menu_'.$mediapress->activeLanguage->code.'_'.$mediapress->activeCountryGroup->code, 7*24*60*60, function()use($mediapress){
        return $mediapress->menu('copyright-menu');
    });
@endphp
@section('footer')
    <footer class="footer">
        <div id="go-btn"></div>
        <div class="container">
            @if( $stores['footer_google_store_url'] && $stores['footer_google_store_url'] != '' &&  $stores['footer_app_store'] && $stores['footer_app_store'] != '')
            <div class="download">
                {!! strip_tags(LangPart('usta_eller_application_download', 'USTA ELLER UYGULAMASINI İNDİR')) !!}
                <nav>
                    @if( $stores['footer_google_store_url'] && $stores['footer_google_store_url'] != '' )
                        <a href="{!! $stores['footer_google_store_url'] !!}" rel="nofollow" target="_blank" aria-label="Google Play"><img data-src="{!! asset('assets/img/google-play.svg') !!}" src="{!! asset('assets/img/lazy.jpg') !!}" class="lazy" alt="Google Play" width="150" height="40"></a>
                    @endif
                    @if( $stores['footer_app_store'] && $stores['footer_app_store'] != '')
                        <a href="{!! $stores['footer_app_store'] !!}" rel="nofollow" target="_blank" aria-label="App Store"><img data-src="{!! asset('assets/img/app-store.svg') !!}" src="{!! asset('assets/img/lazy.jpg') !!}" class="lazy" alt="App Store" width="150" height="40"></a>
                    @endif
                </nav>
            </div>
            @endif
            @if(count($social_medias) > 0)
            <div class="social_media">
                {!! strip_tags(LangPart('follow_us', 'FOLLOW US')) !!}
                <nav>
                    @foreach( $social_medias as $media )
                    <a href="{!! strip_tags($media['url']) !!}" target="_blank" rel="nofollow" aria-label="Sosyal Medya">
                        <img data-src="{!! strip_tags($media['image']) !!}" src="{!! asset('assets/img/lazy.jpg') !!}" class="lazy" alt="{!! strip_tags(LangPart('follow_us', 'FOLLOW US')) !!}" width="30" height="30">
                    </a>
                    @endforeach
                </nav>
            </div>
            @endif
            <div class="altmenu">
                <div class="row">
                    @foreach($footer_menu as $menu)
                    <div class="col-lg-2">
                        <div class="head">{!! $menu->name !!}</div>
                        @if( $menu->children->isNotEmpty() )
                        <ul>
                            @foreach( $menu->children as $children )
                            <li><a href="{!! $children->url !!}">{!! $children->name !!}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
                @if(isset($mediapress) && ($mediapress->activeCountryGroup->code != 'ru' && $mediapress->activeCountryGroup->code != 'rg') )
                    <div class="ebulten">
                {!! LangPart('ebulten_title', 'E-BÜLTEN ABONELİĞİ') !!}
                <form id="eBultenForm">
                    <div class="form-group">
                        <label>
                            <input type="text" name="email" id="email_bulten" placeholder="{!! strip_tags(LangPart('emailText', 'E-Posta*')) !!} *" required autocomplete="off">

                        </label>
                        <div class="invalid-feedback">
                            Bu alan zorunludur.
                        </div>
                        <input type="hidden" name="cg" value="{!! $mediapress->activeCountryGroup->id !!}"/>
                        <input type="hidden" name="lg" value="{!! $mediapress->activeLanguage->id !!}"/>
                       <div class="rights">
                           <div class="flex">
                               <div class="subject">
                                   <div class="titles">
                                       <div class="hd">
                                           <u>{!! LangPart('choose_brand', 'Marka seçiniz') !!}</u>
                                           <u>{!! LangPart('mobil_choose_brand', 'Seç') !!}</u>
                                       </div>
                                       <span><em id="count-checked-checkboxes">0</em> *<i class="fal fa-chevron-down"></i></span>
                                   </div>
                               </div>
                               <div class="checkbox_sub">
                                   @foreach($crm_brands as $crm)
                                       <div class="custom-control custom-checkbox">
                                           <input type="checkbox" name="brands[]" class="custom-control-input" id="{!! $crm['name'] !!}" value="{!! $crm['id'] !!}">
                                           <label class="custom-control-label" for="{!! $crm['name'] !!}">
                                               {!! $crm['name'] !!}
                                           </label>
                                       </div>
                                   @endforeach
                                   <span class="okey_btn">{!! LangPart('okey', 'OKEY') !!}</span>
                               </div>
                           </div>
                           <input type="hidden" name="source" value="{!! $device !!}" />
                           <button type="submit" id="submitEBulten" class="subscribe">{!! LangPart('subscribe', 'ABONE OL') !!}</button>
                       </div>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="kvkk" class="custom-control-input" id="kvkk" value="1">
                        <label class="custom-control-label" for="kvkk">
                            {!! LangPart('ebulten_kvkk_text_new', ':tag_open Bülten Üyeliği Aydınlatma Metni :tag_close kapsamında kimlik ve iletişim verilerimin Kastamonu Enregre tarafından hizmetlerinin tanıtımı, etkinlik ve haberlere ilişkin bilgilendirmelerin yapılması amacıyla işlenmesini ve bununla sınırlı olarak hizmet alınan üçüncü taraflar ile paylaşılmasını ve e-posta adresime reklam, tanıtım ve bilgilendirme vb. ticari elektronik ileti gönderilmesini kabul ediyorum.',
                            ['tag_open'=>'<a href="javascript:;" data-src="#modal" data-fancybox>', 'tag_close'=>'</a>']) !!}

                        </label>
                    </div>
                    <div id="thanks_modal_open" data-src="#thanks_modal" data-fancybox></div>
                    <div id="error_modal_open" data-src="#hata_modal" data-fancybox></div>
                </form>
                <div class="modals" id="modal" style="display: none">
                    <div class="inner">
                        {!! $kvkk_text !!}
                    </div>
                </div>
                <div class="loader_footer">
                    <svg width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg" class="spinner">
                        <circle fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30" class="path"></circle>
                    </svg>
                    Lütfen Bekleyiniz.
                </div>
                <div class="modals thanks_modal" id="thanks_modal" style="display: none">
                    <div class="icons"><img src="{!! asset('assets/img/icon01.svg') !!}" alt="KEAS"></div>
                    <p>{!! LangPart('subscription.successs', 'Teşekkürler, kayıt isteğiniz başarıyla gönderildi. <br> Lütfen onaylamak için e-posta gelen kutunuzu kontrol edin.') !!}</p>
                    <span class="okey_btn" data-fancybox-close>{!! LangPart('okey', 'OKEY') !!}</span>
                </div>
                <div class="modals thanks_modal" id="hata_modal" style="display: none">
                    <div class="icons"><img src="{!! asset('assets/img/icon02.svg') !!}" alt="KEAS"></div>
                    <p>{!! LangPart('ebulten_record_couldnt', 'E-bülten kaydınız yapılamadı. Lütfen tekrar deneyin.') !!} <br>
                        <span class="error_message"></span>
                    </p>
                    <span class="okey_btn" data-fancybox-close>{!! LangPart('okey', 'OKEY') !!}</span>
                </div>
            </div>
                @endif
            <div class="copy">
                <ul>
                    <li>{!! strip_tags(LangPart('copyright_text', '© 2022 Kastamonu Entegre')) !!}</li>
                    @foreach( $copyright_menu as $menu )
                    <li><a href="{!! $menu->type == 1 ? $menu->out_link : $menu->url !!}" rel="nofollow" target="{!! $menu->target !!}">{!! $menu->name !!}</a></li>
                    @endforeach
                </ul>
            </div>
                <div class="legal_information">
             {!! strip_tags(LangPart('legal_information', 'Socio unico - Società soggetta a direzione e coordinamento di KEAS HOLDING B.V. codice fiscale  850162336')) !!}
                </div>
            <!--<div class="footer_lang">
                <span><img src="{!! asset('assets/img/flags/'.\Str::slug($footer_country, '-').'.svg') !!}" alt="">{!! $footer_country ? strip_tags(LangPart(\Str::slug($footer_country, '-'))).' / ': '' !!} {!! strip_tags(LangPart(\Str::slug($footer_language, '-'), $footer_language)) !!}</span>
            </div>!-->
        </div>
    </footer>
@endsection
