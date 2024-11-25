@php
    $pages = \Mediapress\Modules\Content\Models\Page::whereSitemapId(INNOVATION_ST_ID)
    ->where('status' ,1)
    ->whereHas('details', function($query)use($mediapress){
        return $query->where('country_group_id', $mediapress->activeCountryGroup->id)->where('language_id', $mediapress->activeLanguage->id);
    })
    ->orderBy('order')
    ->get();
@endphp
<link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
<link rel="stylesheet" href="{!! asset('frontend/assets/css/innovation.css') !!}">

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
                        @include('web.inc.about-us-menu', ['active_url'=>strip_tags($sitemap->detail->url)])
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="content">
                        <h1>{!! $page->detail->name !!}</h1>
                        {!! $page->detail->detail !!}
                        <div class="row">
                            @foreach($pages as $page)
                            <div class="col-xl-4 col-md-6">
                                <div class="item">
                                    <a href="{!! strip_tags($page->detail->url) !!}">
                                        <picture>
                                            <img data-src="{!! image($page->f_) !!}" class="lazy" alt="{!! $page->detail->name !!}">
                                        </picture>
                                        <b>{!! $page->detail->name !!}</b>
                                        <span class="txt">{!! $page->detail->detail ? \Str::limit(strip_tags($page->detail->detail), 100) : "" !!}</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </article>
</section>
@push('scripts')
    <script src="{!! asset('frontend/assets/js/page.js') !!}"></script>
@endpush
