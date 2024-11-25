<div class="block">
    <div class="row">
        <div class="col-md-3">
            <h3>{!! $categoryName !!} {!! LangPart('surfaces', 'Surfaces') !!}</h3>
        </div>
        <div class="col-md-9">
            <ul class="surfaces">
                @foreach( $surfaces as $surface )
                <li>
                    <div class="icon"><img data-src="{!! $surface['image'] !!}" class="lazy" src="{!! asset('assets/img/lazy.jpg') !!}" alt="{!! $surface['name'] !!}"></div>
                    {!! $surface['name'] !!}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
