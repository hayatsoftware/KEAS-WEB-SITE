@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
@endphp

@section('content')
	@include('ContentWeb::default.sitemap_dynamic_category_criteria.page_detail')
@endsection