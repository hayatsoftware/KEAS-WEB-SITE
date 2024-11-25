
@php
if(!isset($mediapress)){
$mediapress = mediapress();
}

@endphp
@extends('web.inc.app')

@section('content')
    <link rel="stylesheet" href="{!! mp_asset('assets/css/page-static.css') !!}">

    <section class="section">
        <article class="article">
            <div class="container-fluid">
                <div class="content">
                    <div class="a404 text-center">
                        <h1>Sayfa Bulunamadı</h1>
                        <span>Ulaşmaya çalıştığınız sayfa bulunmadı.</span>
                        <p>Lütfen ulaşmak istediğiniz sayfanın adresini doğru yazdığınızı kontrol edin.</p>
                        <p>Eğer doğru adresi yazdığınıza eminseniz, ulaşmak istediğiniz sayfa silinmiş olabilir.</p>
                        <a href="{!! $mediapress->homePageUrl !!}" class="more">Ana Sayfaya Dön</a>
                    </div>
                </div>
            </div>
        </article>

    </section>
@endsection
