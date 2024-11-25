@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $catalogues = $mediapress->data['catalogues'];
    $device = $mediapress->data['device'];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">

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
                                @if($errors->any())
                                <div class="errors">
                                    @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        {{$error}}
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                                @if(session('success'))
                                    <div class="errors">
                                        <div class="alert alert-danger">
                                            {{session('success')}}
                                        </div>
                                    </div>
                                @endif
                               {!! $sitemap->detail->detail !!}
                                <form action="{!! route('SendCatalogue') !!}" method="POST">
                                    @csrf
                                    @foreach($catalogues as $catalogue)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="catalogues[]" class="custom-control-input" id="{!! strip_tags($catalogue->detail->name) !!}" value="{!! $catalogue->cint_1 !!}">
                                        <label class="custom-control-label" for="{!! strip_tags($catalogue->detail->name) !!}">
                                            {!! $catalogue->detail->name !!}
                                        </label>
                                    </div>
                                    @endforeach
                                    <input type="hidden" name="cg" value="{!! $mediapress->activeCountryGroup->id !!}" />
                                    <input type="hidden" name="lg" value="{!! $mediapress->activeLanguage->id !!}" />
                                    <input type="hidden" name="source" value="{!! $device !!}" />
                                    <button type="submit" class="supplier mt-5">{!! LangPart('talep_et', 'TALEP ET') !!}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </article>
    </section>
@endsection
