<div class="block">
    <div class="row">
        <div class="col-md-3">
            @if($category->category_id == 15 || $category->category_id == 16 || $category->category_id == 41 || $category->category_id == 60 || $category->category_id == 64)
                <h3>{!! LangPart('extra_features', 'Extra Features') !!}</h3>
            @else
                <h3>{!! LangPart('features', 'Features') !!}</h3>
            @endif
        </div>
        <div class="col-md-9">
            <ul class="surfaces_1">
                @foreach( $features as $feature )
                <li>
                    <div class="img"><img data-src="{!! $feature['image'] !!}" class="lazy"  src="{!! asset('assets/img/lazy.jpg') !!}" alt="{!! $feature['name'] !!}"></div>
                    {!! $feature['name'] !!}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
