@extends('web.inc.app')

@php
	$page = $mediapress->data['page'];
@endphp

@section('content')
<link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="{!! $mediapress->homePageUrl !!}">{!! LangPart('homepage', 'Homepage') !!}</a></li>
                    <li><a href="{!! strip_tags($page->detail->url) !!}">{!! $page->detail->name !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="content kvkk_content">
                    <h1>{!! $page->detail->name !!}</h1>
                    {!! $page->detail->detail !!}
                </div>
            </div>
        </article>
    </section>
@endsection
