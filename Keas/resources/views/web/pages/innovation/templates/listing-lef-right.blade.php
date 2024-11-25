{!! $page->detail->detail !!}
@php
    $pages = \Mediapress\Modules\Content\Models\Page::where('page_id', $page->id)
    ->whereHas('details', function($query)use($mediapress){
        return $query->where('country_group_id', $mediapress->activeCountryGroup->id)->where('language_id', $mediapress->activeLanguage->id);
    })
    ->where('status', 1)
    ->orderBy('order')
    ->get();
@endphp
@foreach( $pages as $subPage )
<div class="list">
    <h3>{!! $subPage->detail->name !!}</h3>
    <div class="row">
        <div class="col-lg-6">
            {!! $subPage->detail->detail !!}
        </div>
        <div class="col-lg-6">
            <figure>
                <img data-src="{!! image($subPage->f_) !!}" class="lazy" src="{!! asset('assets/img/lazy.jpg') !!}" alt="">
            </figure>
        </div>
    </div>
</div>
<br>
<br>
@endforeach
