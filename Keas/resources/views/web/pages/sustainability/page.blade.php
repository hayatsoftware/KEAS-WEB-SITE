@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $page = $mediapress->data['page'];
@endphp

@section('content')
    @if( $page->cint_1 == 1 )
        @include('web.pages.innovation.sitemap', ['page'=>$page, 'sitemap'=>$sitemap, 'mediapress'=>$mediapress])
    @elseif( $page->cint_1 == 2 )
        @include('web.pages.quality.sitemap', ['page'=>$page, 'sitemap'=>$sitemap, 'mediapress'=>$mediapress])
    @elseif( $page->cint_1 == 3 )
        @include('web.pages.environment.sitemap', ['page'=>$page, 'sitemap'=>$sitemap, 'mediapress'=>$mediapress])
    @else
        @include('web.pages.sustainability.default')
    @endif
@endsection

