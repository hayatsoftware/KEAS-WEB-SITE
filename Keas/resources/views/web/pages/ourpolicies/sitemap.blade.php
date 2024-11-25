@php
    $pages = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', OUR_POLICIES_ST_ID)
                ->whereHas('details', function($query)use($mediapress){
                    return $query->where('country_group_id', $mediapress->activeCountryGroup->id)->where('language_id', $mediapress->activeLanguage->id);
                })
                ->where('status', 1)
                ->orderBy('order')
                ->get();
@endphp
<div class="row">
    @foreach($pages as $page)
    <div class="col-xl-4 col-md-6">
        <div class="item">
            <a href="{!! strip_tags($page->detail->url) !!}">
                <picture>
                    <img data-src="{!! $page->detail->f_ ? image($page->detail->f_) : image($page->f_) !!}" class="lazy" alt="">
                </picture>
                <b>{!! $page->detail->name !!}</b>
            </a>
        </div>
    </div>
    @endforeach
</div>
