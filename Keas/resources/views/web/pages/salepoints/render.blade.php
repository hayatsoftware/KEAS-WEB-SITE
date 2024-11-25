@foreach($points as $key => $point)
    <li class="sale">
        <b onclick="showOnMap({!! $point['lat'] !!}, {!! $point['lng'] !!}, {!! $key !!})"><i></i>{!! $point['name'] !!}</b>
        <ul>
            <li>{!! $point['address'] !!}, {!! $point['city'] !!}</li>
            @if(!empty($point['phone']) && $point['phone'] != '-')
            <li><i class="far fa-phone"></i><a href="tel:{!! str_replace(" ","",$point['phone']) !!}">{!! $point['phone'] !!}</a></li>
            @endif
            @if(!empty($point['email']) && $point['email'] != '-')
            <li><i class="far fa-envelope"></i><a href="mailto:{!! $point['email'] !!}">{!! $point['email'] !!}</a></li>
            @endif
            @if( !empty($point['website']) && $point['website'] != '-' )
            <li><i class="far fa-earth-americas"></i><a href="https://{!! $point['website'] !!}/" target="_blank">{!! $point['website'] !!}</a></li>
            @endif

            <li><a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination={!! $point['lat'] !!},{!! $point['lng'] !!}" class="maps mapButtonLink" data-latitude="{!! $point['lat'] !!}" data-longitude="{!! $point['lng'] !!}" ><i class="fal fa-location-dot"></i>{!! strip_tags(LangPart('yol_tarifi', 'Yol Tarifi')) !!}</a></li>
        </ul>
    </li>
@endforeach
