@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $pages = $mediapress->data['pages'] ?? [];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/our-milestones.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('about_us', 'About Us') !!}</a></li>
                    <li><a href="#">{!! LangPart('company_profile', 'Company Profile') !!}</a></li>
                    <li><a href="{!! $sitemap->detail->url !!}">{!! $sitemap->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar">
                            @include('web.inc.about-us-menu')
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="content">
                            <h1>{!! $sitemap->detail->name !!}</h1>
                            <ul>
                                @foreach($pages as $page)
                                    @php $detail = $page->detail @endphp
                                    <li>
                                        <i></i>
                                        <div class="text">
                                            <b>{!! $detail->name !!}</b>
                                            {!! $detail->detail !!}
                                        </div>
                                        <div class="images">
                                            <picture><img data-src="{!! $page->detail->f_ ? image($page->detail->f_) : image($page->f_) !!}" alt="" class="lazy"></picture>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
@push('scripts')
    <script src="{!! asset('frontend/assets/js/page.js') !!}"></script>

    <script>
        $(window).scroll(function () {
            $('.section .article .content ul li').each( function(i){

                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height()-300;

                /* If the object is completely visible in the window, fade it it */
                if( bottom_of_window > bottom_of_object ){

                    $(this).addClass('active');

                }
                if( bottom_of_window < bottom_of_object ){

                    $(this).removeClass('active');

                }
            });
        });
    </script>

@endpush
