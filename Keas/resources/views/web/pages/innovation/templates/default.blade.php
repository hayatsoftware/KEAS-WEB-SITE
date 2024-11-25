<div class="row">
    <div class="col-xl-5 order-xl-1">
        @include('web.pages.innovation.parts.gallery')
    </div>
    <div class="col-xl-7">
        <div class="sticky">
            {!! $page->detail->detail !!}
            <div class="share">
                <ul class="text-left">
                    <li class="back"><a href="{!! strip_tags($InnovationPage->detail->url) !!}">{!! LangPart('back', 'BACK') !!}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
