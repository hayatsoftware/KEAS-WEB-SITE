@extends('web.inc.app')

@php
	$sitemap = $mediapress->data['sitemap'];
    $breadcrumbs = $mediapress->data['breadcrumbs'];
    $data = $mediapress->data['data'];
    $category = $mediapress->data['category'];
    $galleries = $mediapress->data['galleries'] ?? [];
    $mdf_pages = $mediapress->data['mdf_pages'];
    $documents = $mediapress->data['documents'] ?? [];
@endphp

@section('content')
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/page.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/slick.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/documents.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/assets/css/medepan.css?v=02') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="page_banner">
                <div class="breadcrump">
                    <ul>
                        @foreach($breadcrumbs as $crumb)
                            <li><a href="{!! $crumb['url'] !!}">{!! $crumb['name'] !!}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="page-title">
                    <div class="container">
                        @if(isset($data['brand']))
                            @php
                                $brandImage = asset('assets/img/brands/'.\Str::slug($data['brand']->name)).'.svg';
                                if( !is_null($data['brand']->cover_image_id)  ){
                                    $brandImage = get_image($data['brand']->cover_image_id);
                                }
                            @endphp
                            <img src="{!! $brandImage !!}" alt="{!! $data['brand']->name !!}">
                        @endif
                        @if($category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64)
                            <img src="{!! $category->parent->f_banner_layer_image ? image($category->parent->f_banner_layer_image) : asset('assets/img/brands/'.\Str::slug(strip_tags($category->parent->detail->name))).'.svg' !!}" alt="{!! strip_tags($category->parent->detail->name) !!}">
                        @endif
                        @if( $category->category_id == 72 )
                            <strong data-in-effect="flipInX" class="effect">{!!$category->parent->detail->name !!}</strong>
                        @endif
                        @if($data['category_title'])
                            @if( isset($data['summary']) )
                            <strong data-in-effect="flipInX" class="effect">{!! $data['summary'] !!}</strong>
                            @endif
                            <p data-in-effect="fadeIn" class="effect">{!! $data['category_title_text'] !!}</p>
                        @endif
                    </div>
                </div>
                <div class="bg" style="background-image: url('{!! $category->f_background ? image($category->f_background):image($category->parent->f_background) !!}')"></div>
            </div>
        </div>
        <article class="article">
            <div class="container">
                <div class="content text-center">
                    <div class="block">
                        <div class="features_1">
                            <div class="row m-0">
                                <div class="col-md-6 p-0">
                                    <figure>
                                        <a href="{!! str_replace(" ","",$data['image']) !!}" data-fancybox="ürün">
                                            <img src="{!! str_replace(" ","",$data['image']) !!}" alt=""></a>
                                    </figure>
                                </div>
                                <div class="col-md-6 p-0">
                                    <div class="table">
                                        <h1>{!! $data['title'] !!}</h1>
                                        <div class="inner">
                                            <ul>
                                                @if($data['category_title'])
                                                <li>
                                                    <span class="title">{!! LangPart('product_type', 'Ürün Tipi') !!}</span><span>{!! $data['category_title_text'] !!}</span>
                                                </li>
                                                @else
                                                    <li>
                                                        <span class="title">{!! LangPart('product_name', 'Ürün Adı') !!}</span><span>{!! $data['title'] !!}</span>
                                                    </li>
                                                @endif
                                                @if($data['decor_code'])
                                                <li>
                                                    <span class="title">{!! LangPart('code', 'Kodu') !!}</span><span>{!! $data['decor_code'] !!}</span>
                                                </li>
                                                @endif
                                                @if( isset($data['brand']) )
                                                <li>
                                                    <span class="title">{!! LangPart('brand', 'Marka') !!}</span><span>{!! $data['brand']->name !!}</span>
                                                </li>
                                                @endif
                                                @if(isset($data['dimensions']))
                                                <li>
                                                    <span class="title">{!! LangPart('dimension', 'Ebat') !!}</span>
                                                    @foreach($data['dimensions'] as $dimension)
                                                        <span class="right_col">{!! $dimension !!}</span>
                                                    @endforeach
                                                </li>
                                                @endif
                                                @if(isset($data['thicknesses']))
                                                <li>
                                                    <span class="title">{!! LangPart('thickness', 'Kalınlık') !!}</span><span>{!! $data['thicknesses'] !!}</span>
                                                </li>
                                                @endif
                                                @if(isset($data['decors']))
                                                <li>
                                                    <span class="title">{!! LangPart('decor', 'Dekor') !!}</span><span>{!! $data['decors'] !!}</span>
                                                </li>
                                                @endif
                                                @if(isset($data['surfaces']))
                                                <li>
                                                    <span class="title">{!! LangPart('surface', 'Yüzey') !!}</span><span>{!! $data['surfaces'] !!}</span>
                                                </li>
                                                @endif
                                                @if(isset($data['extra_features']))
                                                <li>
                                                    <span class="title">{!! LangPart('extra_features', 'Ek Özellikler') !!}</span>
                                                    @foreach(explode(',', $data['extra_features']) as $feature)
                                                    <span>{!! $feature !!}</span>
                                                    @endforeach
                                                </li>
                                                @endif
                                                @if(isset($data['locks']))
                                                    <li>
                                                        <span class="title">{!! LangPart('locks', 'Locks') !!}</span><span>{!! $data['locks'] !!}</span>
                                                    </li>
                                                @endif
                                                @if(isset($data['bevels']))
                                                    <li>
                                                        <span class="title">{!! LangPart('bevels', 'Bevels') !!}</span><span>{!! $data['bevels'] !!}</span>
                                                    </li>
                                                @endif
                                                @if(isset($data['class']))
                                                    <li>
                                                        <span class="title">{!! LangPart('class_info', 'Class Info') !!}</span><span>{!! $data['class'] !!}</span>
                                                    </li>
                                                @endif
                                                @if(isset($data['areas']))
                                                    <li>
                                                        <span class="title">{!! LangPart('area_meter', 'Area (m2)') !!}</span><span>{!! $data['areas'] !!}</span>
                                                    </li>
                                                @endif
                                                @isset($data['length'])
                                                        <li>
                                                            <span class="title">{!! LangPart('product_info_length', 'Length') !!}</span><span>{!! $data['length'] !!}</span>
                                                        </li>
                                                @endisset
                                                @isset($data['material'])
                                                    <li>
                                                        <span class="title">{!! LangPart('material', 'Material') !!}</span><span>{!! $data['material'] !!}</span>
                                                    </li>
                                                @endisset
                                                @isset($data['edge_band'])
                                                    <li>
                                                        <span class="title">{!! LangPart('edge_band', 'Edge Band') !!}</span><a href="{{$data['edge_band_url']}}" target="_blank"><span>{!! $data['edge_band'] !!}</span></a>
                                                    </li>
                                                @endisset
                                                @isset($data['compatible_panel'])
                                                    <li>
                                                        <span class="title">{!! LangPart('compatible_panel', 'Compatible Panel') !!}</span><a href="{{$data['compatible_panel_url']}}" target="_blank"><span>{!! $data['compatible_panel'] !!}</span></a>
                                                    </li>
                                                @endisset
                                            </ul>
                                        </div>
                                        <div class="not">
                                            {!! LangPart('product_note_field', 'The colors may vary on digital media. Please check with original sample.') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="buttons">
                            @if( $category->category_id != 2 && $category->category_id != 72 )
                                @if( $data['threed'] )
                                <li><a href="javascript:void(0)" class="ucd id-01">{!! LangPart('view_3d', '3D GÖRÜNTÜLE') !!}</a></li>
                                @endif
                                @if( $data['virtual_room'] )
                                <li><a href="javascript:void(0)" class="showroom">{!! LangPart('virtual_room', 'SANAL SHOWROOM') !!}</a></li>
                                @endif
                                @if( $data['see_in_room'] )
                                <li><a href="javascript:void(0)" class="mimarim_ol">{!! LangPart('see_in_my_room', 'ODAMDA GÖR') !!}</a></li>
                                @endif
                            @endif
                            <li><a href="{!! getUrlBySitemapId(SALE_POINTS_ST_ID) !!}" class="dealer">{!! LangPart('find_network', 'BAYİ BUL') !!}</a></li>
                        </ul>
                    </div>
                    <div class="block">
                        @if(isset($data['detail_title']) && !empty(strip_tags($data['detail'])))
                            <h2>{!! $data['detail_title'] !!}</h2>
                        @endif
                        @if($category->id == 2 || $category->category_id == 2)
                            <h2>{!! LangPart('about_product', 'ÜRÜN HAKKINDA') !!}</h2>
                        @endif
                        {!! $data['detail'] !!}
                    </div>
                    @if(isset($data['certificates']))
                    <div class="block">
                        <h2>{!! LangPart('certificates_big', 'CERTIFICATES') !!}</h2>
                        <ul class="certificates">
                            @foreach( $data['certificates'] as $certificate )
                            <li data-toggle="tooltip" data-placement="top" title="{!! $certificate->name !!}">
                                <span>
                                    @php

                                        if( !is_null($certificate->native_cover_image_id) ){
                                            $certImage = get_image($certificate->native_cover_image_id);
                                        }elseif( !is_null($certificate->cover_image_id) ){
                                            $certImage = get_image($certificate->cover_image_id);
                                        }elseif( \File::exists(public_path('assets/img/certificates/'.$mediapress->activeLanguage->code.'/'.\Str::slug($certificate->english_name, '-').'.png')) ){
                                            $certImage = asset('assets/img/certificates/'.$mediapress->activeLanguage->code.'/'.\Str::slug($certificate->english_name, '-').'.png');
                                        }else{
                                            $settings = \Mediapress\Modules\Content\Models\Sitemap::find(1);
                                            $certImage = image($settings->f_default_certificate);
                                        }
                                    @endphp
                                    <img src="{!! $certImage !!}" alt="{!! $certificate->name !!}">
                                </span>

                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(isset($data['feature']))
                    <div class="block">
                        <h2>{!! LangPart('features_uppercase', 'FEATURES') !!}</h2>
                        <ul class="features_2">
                            @foreach($data['feature'] as $feature)
                            <li>
                                <div class="img">
                                    @php
                                        if( !is_null($feature->cover_image_id) ){
                                            $featureImage = get_image($feature->cover_image_id);
                                        }elseif( \File::exists(public_path('assets/img/features/'.\Str::slug($feature->english_name, '-').'.png')) ){
                                            $featureImage = asset('assets/img/features/'.\Str::slug($feature->english_name, '-').'.png');
                                        }else{
                                            $settings = \Mediapress\Modules\Content\Models\Sitemap::find(1);
                                            $featureImage = image($settings->f_default_feature);
                                        }
                                    @endphp
                                    <img src="{!! $featureImage !!}" alt="FEATURES">
                                </div>
                                {!! $feature->name !!}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(isset($data['usages']) && !empty(strip_tags($data['usages'])))
                    <div class="block">
                        <h2>{!! LangPart('usages_uppercase', 'KULLANIM ALANLARI') !!}</h2>
                        {!! $data['usages'] !!}
                    </div>
                    @endif

                    @if($data['layer_image'])
                        <div class="block">
                            <h2>{!! LangPart('layers', 'LAYERS') !!}</h2>
                            <p><img class="layers" src="{!! $data['layer_image'] !!}" alt="LAYERS"></p>
                        </div>
                    @endif

                    @if($galleries)
                    <div class="block">
                        <h2>{!! LangPart('photo_gallery', 'Photo Gallery') !!}</h2>
                        <div class="photo_gallery">
                            @foreach($galleries as $gallery)
                            <div class="item">
                                <img data-lazy="{!! $gallery !!}" alt="Photo Gallery">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if($mdf_pages)
                        <div class="block features">
                            <div class="row">
                                @foreach($mdf_pages as $page)
                                <div class="col-md-6 pr-lg-5">
                                    <div class="item">
                                        <h2>{!! $page->name !!}</h2>
                                        <small>({!! $page->summary_value !!})</small>
                                        {!! $page->detail !!}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if( count($documents) > 0 )
                    <div class="block">
                        <h2>{!! LangPart('documents', 'Documents') !!}</h2>
                        <div class="documents">
                            @foreach($documents as $document)
                            <a href="{!! $document['file'] !!}">
                                {!! $document['name'] !!}
                                <div class="rights">
                                    <small>{!! $document['size'] !!}</small>
                                    <span>{!! LangPart('download', 'Download') !!}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </article>
    </section>
    @if( $data['threed'] )
    <div id="id-01" class="modal_01">
        <div class="inner">
            <div class="all">
                <div class="close"></div>
                <iframe data-src="{!! $data['threed'] !!}" frameborder="0"></iframe>
            </div>
        </div>
    </div>
    @endif

    @if( $data['virtual_room'] )
    <div id="showroom_modal" class="modal_01">
        <div class="inner">
            <div class="all">
                <div class="close"></div>
                <iframe data-src="{!! $data['virtual_room'].''.$data['id'] !!}" frameborder="0"></iframe>
            </div>
        </div>
    </div>
    @endif
    @if( $data['see_in_room'] )
    <div id="see_in_room" class="modal_01">
        <div class="inner">
            <div class="all">
                <div class="close"></div>
                <iframe data-src="{!! $data['see_in_room'].''.$data['id'] !!}" frameborder="0"></iframe>
            </div>
        </div>
    </div>
    @endif
@endsection
@push('scripts')
    <script src="{!! asset('frontend/assets/js/slick.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/products.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/bootstrap.js') !!}"></script>
    <script src="{!! asset('frontend/assets/js/tunus-mermer.js') !!}"></script>
@endpush
