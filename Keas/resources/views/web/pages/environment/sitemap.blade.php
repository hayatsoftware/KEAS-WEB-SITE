@php
    $documents = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', DOCUMENT_ST_ID)
                    ->where('status', 1)
                    ->where('cint_3', 1)
                    ->whereHas('details', function($query)use($mediapress){
                        return $query->where('name', '!=', NULL)
                        ->where('name', '<>', '')
                        ->where('language_id', $mediapress->activeLanguage->id)
                        ->where('country_group_id', $mediapress->activeCountryGroup->id);
                    })
                    ->get();
@endphp
@push('styles')
    <style>
        .fancybox-slide {
            padding: 0 !important;
        }
    </style>
@endpush
<link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
<link rel="stylesheet" href="{!! asset('frontend/assets/css/applications.css') !!}">
<link rel="stylesheet" href="{!! asset('frontend/assets/css/certificates.css') !!}">
<section class="section">
    <div class="container-fluid">
        <div class="breadcrump">
            <ul>
                <li><a href="#">{!! LangPart('abouts_us', 'About Us') !!}</a></li>
                <li><a href="{!! strip_tags($sitemap->detail->url) !!}">{!! $sitemap->detail->name !!}</a></li>
                <li><a href="{!! strip_tags($page->detail->url) !!}">{!! $page->detail->name !!}</a></li>
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
                        <h1>{!! $page->detail->name !!}</h1>
                        {!! $page->detail->detail !!}
                        @if($documents->isNotEmpty())
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="block">
                                    <div id="lightboxGallery" class="documents">
                                        @foreach($documents as $document)
                                            @if(!empty(strip_tags($document->detail->file_embed)))
                                                <a href="{{strip_tags($document->detail->file_embed)}}" data-fancybox data-type="iframe">
                                                    {{strip_tags($document->detail->name)}}
                                                    <div class="rights">
                                                        <span>{!! LangPart('view', 'View') !!}</span>
                                                    </div>
                                                </a>
                                            @else
                                                <a href="{{strip_tags(image($document->detail->f_document))}}">
                                                    {{strip_tags($document->detail->name)}}
                                                    <div class="rights">
                                                        <span>{!! LangPart('view', 'View') !!}</span>
                                                    </div>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>
@push('scripts')
    <script src="{!! mp_asset('frontend/assets/js/page.js') !!}"></script>
@endpush
