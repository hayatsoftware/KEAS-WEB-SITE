@extends('web.inc.app')
@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/panel.css') !!}">
    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump m-0">
                <ul>
                    <li><a href="#">{!! LangPart('products', 'Products') !!}</a></li>
                    <li><a href="{!! $category->detail->url !!}">{!! $category->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="content">
                    <h1>{!! mb_strtoupper($category->detail->name) !!}</h1>
                    <div class="row">
                        @foreach( $category->children as $children )
                            @if($children->detail)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="list">
                                    <a href="{!! $children->detail->url !!}">
                                        <picture>
                                            <img src="{!! $children->detail->f_zone_homepage ? image($children->detail->f_zone_homepage):image($children->f_homepage) !!}" alt="Products">
                                        </picture>
                                        <span>{!! $children->detail->name !!}</span>
                                    </a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </article>
    </section>
@endsection
