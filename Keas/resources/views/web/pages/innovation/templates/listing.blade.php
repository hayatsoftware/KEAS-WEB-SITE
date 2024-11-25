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
@foreach($pages as $subPage)
<div class="list-01">
    <div class="row">
        <div class="col-lg-4">
            <figure>
                <img data-src="{!! strip_tags($subPage->detail->f_) ? image($subPage->detail->f_): image($subPage->f_) !!}" class="lazy" src="{!! asset('assets/img/lazy.jpg') !!}" alt="">
            </figure>
        </div>
        <div class="col-lg-8">
            <h3>{!! $subPage->detail->name !!}</h3>
            {!! $subPage->detail->detail !!}
        </div>
    </div>
</div>
@endforeach
@push('scripts')
    <script src="{!! asset('frontend/assets/js/inovasyon.js') !!}"></script>
@endpush
