@php
    $media_menu = \Cache::remember('media_menu_'.$mediapress->activeLanguage->code.'_'.$mediapress->activeCountryGroup->code, 7*24*60*60, function()use($mediapress){
        return $mediapress->menu('media-menu');
    });
@endphp
<ul>
    @foreach($media_menu as $menu)
        <li class="{!! $menu->children->isNotEmpty() ? 'down':'' !!} {!! request()->url() == url($menu->url) ? 'active':'' !!}">
            <a href="{!! $menu->url ?? '#' !!}">{!! $menu->name !!}</a>
            @if( $menu->children->isNotEmpty() )
                <ul>
                    @foreach( $menu->children as $children )
                        <li class="{!! request()->url() == url($menu->url) ? 'active':'' !!}">
                            <a href="{!! $children->url ?? '#' !!}">{!! $children->name !!}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
