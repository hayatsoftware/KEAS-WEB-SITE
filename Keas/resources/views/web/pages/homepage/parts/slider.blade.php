<div class="homes">
    <div class="home_slider">
        @foreach( $sliders as $slider )
            @if( $slider['type'] == 'video' )
            <div class="item video" data-video-start="4">
                <iframe class="embed-player slide-media" src="{!! $slider['video_url'] !!}" data-src="{!! $slider['video_url'] !!}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen title="{!! $slider['video_slogan'] !!}"></iframe>

                <div class="slogan">
                    <div class="line1"><img width="778" height="83" data-lazy="{!! $slider['video_layer_image'] !!}" src="{!! asset('assets/img/lazy.jpg') !!}" alt="{!! $slider['video_slogan'] !!}"></div>
                    <div class="line3">{!! $slider['video_slogan'] !!}</div>
                    <a href="{!! $slider['button_url'] !!}" data-fancybox class="btn">{!! $slider['button_text'] !!}</a>
                </div>
            </div>
            @endif
            @if( $slider['type'] == 'image' )
                <div class="item">
                    <picture>
                        <source media="(max-width:500px)" srcset="Mobil görsel src alanı">
                        <img src="{!! $slider['slider_image'] !!}"  class="u-cover" alt="KEAS" width="1920" height="1080">
                    </picture>
                    <div class="slogan">
                        @if( !is_null( $slider['line_text_one']) )
                        <div class="line1">{!! $slider['line_text_one'] !!} </div>
                        @endif
                        @if(!is_null($slider['line_text_two']))
                        <div class="line2">{!! $slider['line_text_two'] !!} </div>
                        @endif
                        @if(!is_null($slider['line_text_three']))
                        <div class="line3">{!! $slider['line_text_three'] !!}</div>
                        @endif
                        @if( !is_null($slider['button_text']) )
                        <a href="{!! $slider['button_url'] !!}" class="btn">{!! $slider['button_text'] !!}</a>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach

    </div>
    <div class="scroll text-center">
        <!--<em>{!! LangPart('explore', 'KEŞFET') !!}</em>-->
        <div class="sc"><span class="scroll-btn"></span></div>
    </div>
</div>
