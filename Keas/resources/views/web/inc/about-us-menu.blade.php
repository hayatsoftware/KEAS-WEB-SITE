@php
    $sidebar_menu = \Cache::remember('sidebar_menu_'.$mediapress->activeLanguage->code.'_'.$mediapress->activeCountryGroup->code, 7*24*60*60, function()use($mediapress){
        return $mediapress->menu('sidebar-menu');
    });

@endphp
<ul>
    @foreach($sidebar_menu as $menu)
        <li class="{!! $menu->children->isNotEmpty() ? 'down':'' !!} {!! request()->url() == url($menu->url) || ( isset($active_url) &&  url($menu->url) == url($active_url) ) ? 'active open':'' !!}">
            <a href="{!! $menu->url ?? '#' !!}">{!! $menu->name !!}</a>
        @if( $menu->children->isNotEmpty() )
            <ul>
                @foreach( $menu->children as $children )
                <li class="{!! request()->url() == url($children->url) ? 'active':'' !!}">
                    <a href="{!! $children->url ?? '#' !!}">{!! $children->name !!}</a>
                </li>
                @endforeach
            </ul>
        @endif
        </li>
    @endforeach
</ul>
