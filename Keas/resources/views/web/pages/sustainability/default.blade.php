<link rel="stylesheet" href="{!! asset('frontend/assets/css/page-static.css') !!}">
<link rel="stylesheet" href="{!! asset('frontend/assets/css/applications.css') !!}">

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
                    </div>
                </div>
            </div>

        </div>
    </article>
</section>
@push('scripts')
    <script src="{!! mp_asset('frontend/assets/js/page.js') !!}"></script>
@endpush
