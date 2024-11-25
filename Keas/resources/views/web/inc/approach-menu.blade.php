@php
    $sitemap_approach = \Mediapress\Modules\Content\Models\Sitemap::find(GENERAL_APPROACH_ST_ID);
    $approach_pages = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', GENERAL_APPROACH_ST_ID)->where('status', 1)->orderBy('order')->get();

@endphp
<ul>
    <li class="{!! request()->url() == url(strip_tags($sitemap->detail->url )) ? 'active':'' !!}"><a href="{!! strip_tags($sitemap_approach->detail->url) !!}">{!! $sitemap_approach->detail->name !!}</a></li>
    @foreach($approach_pages as $page)
    <li class="{!! request()->url() == url(strip_tags($page->detail->url )) ? 'active':'' !!}">
        <a href="{!! strip_tags($page->detail->url) !!}">{!! $page->detail->name !!}</a>
    </li>
    @endforeach
</ul>
