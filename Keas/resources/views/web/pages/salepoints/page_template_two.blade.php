@extends('web.inc.app')

@php
    $sitemap = $mediapress->data['sitemap'];
    $agents = $mediapress->data['agents'] ?? [];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/sales-points.css') !!}">
    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="#">{!! LangPart('contact', 'Contact') !!}</a></li>
                    <li><a href="{!! $sitemap->detail->url !!}">{!! $sitemap->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="content">
                    <h1>{!! $sitemap->detail->name !!}</h1>
                    <div class="row">
                        @if( $mediapress->activeCountryGroup->id == 6 )
                        <div class="col-lg-4 order-lg-1">
                            <div class="sticky"><img src="{!! asset('assets/img/lazy.jpg') !!}" data-src="{!! asset('assets/img/harita.svg') !!}" class="lazy" alt=""></div>
                        </div>
                        @endif
                        <div class="{!! $mediapress->activeCountryGroup->id == 6 ? 'col-lg-8':'col-lg-12' !!}">
                            <div class="row">
                                @if($mediapress->activeCountryGroup->id == 6)
                                    @foreach($agents as $key => $agent_items)
                                        <h3>{{ LangPart(\Str::slug($key, '-'), $key) }}</h3>
                                        @foreach($agent_items as $agent)
                                            @if($agent->detail)
                                            <div class="{!! $mediapress->activeCountryGroup->id == 6 ? 'col-lg-6 actives active':'col-lg-4 actives active' !!}">
                                                <div class="sales_list">
                                                    <b>{!! $agent->detail->name !!} </b>
                                                    <span>{!! $agent->detail->summary !!} </span>
                                                    <ul>
                                                        <li class="phone">
                                                            <strong>{!! LangPart('phone', 'Phone') !!}</strong>
                                                            <a href="tel:{!! str_replace(" ","",$agent->cvar_1) !!}">{!! $agent->cvar_1 !!}</a>
                                                        </li>
                                                        <li class="mail">
                                                            <strong>E-Mail</strong>
                                                            <a href="mailto:{!! $agent->cvar_2 !!}">{!! $agent->cvar_2 !!}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @else
                                    @foreach($agents as $agent)
                                    <div class="{!! $mediapress->activeCountryGroup->id == 6 ? 'col-lg-6 actives active':'col-lg-4 actives active' !!}">
                                        <div class="sales_list">
                                            <b>{!! $agent['name'] !!} </b>
                                            <span>{!! $agent['service'] !!} </span>
                                            <ul>
                                                <li class="phone">
                                                    <strong>{!! LangPart('phone', 'Phone') !!}</strong>
                                                    <a href="tel:{!! str_replace(" ","",$agent['phone']) !!}">{!! $agent['phone'] !!}</a>
                                                </li>
                                                <li class="mail">
                                                    <strong>E-Mail</strong>
                                                    <a href="mailto:{!! $agent['email'] !!}">{!! $agent['email'] !!}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </article>
    </section>

@endsection
@push('scripts')
    <script>
        $('.actives:nth-child(1)').addClass('active');
        $('.actives:nth-child(2)').addClass('active');
        $('.actives:nth-child(3)').addClass('active');
        $('.actives:nth-child(4)').addClass('active');
        $(window).scroll(function () {
            $('.actives').each( function(i){

                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height();
                if( bottom_of_window > bottom_of_object ){
                    $(this).addClass('active');
                }
            });
        });
    </script>
@endpush
