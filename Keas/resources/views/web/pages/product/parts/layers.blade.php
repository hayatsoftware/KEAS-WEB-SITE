<div class="block">
    <div class="row">
        <div class="col-md-3">
            <h3>{!! LangPart('layers', 'Layers') !!}</h3>
        </div>
        <div class="col-md-9">
            @if(  $category->detail->f_layer_image_zone )
                <img data-src="{!! $category->detail->f_layer_image_zone !!}" class="lazy"  src="{!! asset('assets/img/lazy.jpg') !!}" alt="{!! strip_tags($category->detail->name) !!}">
            @elseif( $category->f_layer_image )
                <img data-src="{!! $category->f_layer_image !!}" class="lazy"  src="{!! asset('assets/img/lazy.jpg') !!}" alt="{!! strip_tags($category->detail->name) !!}">
            @elseif( $parent_category->detail->f_layer_image_zone )
                <img data-src="{!! $parent_category->detail->f_layer_image_zone !!}" class="lazy"  src="{!! asset('assets/img/lazy.jpg') !!}" alt="{!! strip_tags($category->detail->name) !!}">
            @else
                <img data-src="{!! $parent_category->f_layer_image !!}" class="lazy"  src="{!! asset('assets/img/lazy.jpg') !!}" alt="{!! strip_tags($category->detail->name) !!}">
            @endif

        </div>
    </div>
</div>
