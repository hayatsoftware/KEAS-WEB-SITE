<div id="{!! $id !!}" class="group">
    <div class="block">
        <div class="head">{!! $title !!}</div>
        <div class="row">
            @foreach($offices as $office)
            <div class="col-lg-6 col-md-6">
                <div class="list">
                    <div class="inner">
                        <b>{!! $office->detail->name !!}</b>
                        {!! $office->detail->detail !!}
                    </div>
                    @if( $office->cvar_1 && !empty(strip_tags($office->cvar_1)) )
                        <a href="{!! strip_tags($office->cvar_1) !!}" target="_blank" class="btn1">{!! LangPart('show_on_map', 'Haritada Göster') !!}</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
