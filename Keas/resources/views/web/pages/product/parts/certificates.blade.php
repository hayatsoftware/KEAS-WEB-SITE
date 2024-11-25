<div class="block">
    <div class="row">
        <div class="col-md-3">
            <h3>{!! LangPart('certificates', 'Certificates') !!}</h3>
        </div>
        <div class="col-md-9">
            <ul class="features_2">
                @foreach( $certs as $cert )
                    <li data-toggle="tooltip" data-placement="top" title="{!! $cert['name'] !!}">
                        <div class="img"><img data-src="{!! $cert['image'] !!}" class="lazy" src="{!! asset('assets/img/lazy.jpg') !!}" alt="{!! $cert['name'] !!}"></div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
