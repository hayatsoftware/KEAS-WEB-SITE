<div class="sticky_01">
    <div>
        @if( $page->detail->f_ )
            @if( $page->detail->f_gallery_zone[0] )
                @foreach( $page->detail->f_gallery_zone as $gallery )
                    <picture>
                        <img src="{!! image($gallery) !!}" alt="">
                    </picture>
                @endforeach
            @else
                <picture>
                    <img src="{!! image($page->detail->f_gallery_zone) !!}" alt="">
                </picture>
            @endif
        @endif

        @if( $page->f_gallery )
            @if( $page->f_gallery[0] )
                @foreach( $page->f_gallery as $gallery )
                    <picture>
                        <img src="{!! image($gallery) !!}" alt="">
                    </picture>
                @endforeach
            @else
                <picture>
                    <img src="{!! image($page->f_gallery) !!}" alt="">
                </picture>
            @endif
        @endif
        @php
            $video = $page->detail->video_url && strip_tags($page->detail->video_url) != "" ? $page->detail->video_url : strip_tags($page->cvar_1);
        @endphp
        @if( $page->detail->video_url && strip_tags($page->detail->video_url) != "" )

        @endif
        @if( $video && $video != "" )
            <div class="videos mt-0">
                <a href="{!! strip_tags($video) !!}" data-fancybox="">
                    <picture>
                        @if( $page->f_video_image )
                            <img class="lazy" src="{!! image($page->f_video_image) !!}" alt="" style="">
                        @endif
                        <div class="playIco">
                            <i class="fas fa-play"></i>
                        </div>
                    </picture>
                </a>
            </div>
        @endif
    </div>

</div>
