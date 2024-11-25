<div class="block">
    <div class="row">
        <div class="col-md-3">
            <h3>{!! LangPart('category_classification_title', ':name Classifications', ['name'=>$category]) !!}</h3>
        </div>
        <div class="col-md-9">
            @foreach( $classifications as $key => $classificationList )
            <div class="list">
                <div class="icons">
                    <img data-src="{!! asset('assets/img/classifications/'.$key.'.svg') !!}" class="lazy"  src="{!! asset('assets/img/lazy.jpg') !!}" alt="">
                </div>
                @foreach( $classificationList as $classification )
                    <div class="lists">
                        <b>{!! $classification['name'] !!}</b>
                        {!! $classification['detail'] !!}
                    </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
