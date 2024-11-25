@extends('web.inc.app')
@php
    $settings = \Mediapress\Modules\Content\Models\Sitemap::find(1);
    $brandPage = false;
@endphp
@section('content')
    <link rel="stylesheet" href="{!! mp_asset('assets/css/page-static.css') !!}">

    <section class="section">
        <div class="container-fluid">
            <div class="breadcrump">
                <ul>
                    <li><a href="{!! getUrlBySitemapId(1) !!}">{!! LangPart('homepage', 'Homepage') !!}</a></li>
                    <li><a href="{!! request()->url() !!}">{!! LangPart('search', 'Arama') !!}</a></li>
                </ul>
            </div>
        </div>
        <article class="article">
            <div class="container-fluid">
                <div class="content">
                    <h1>{!! LangPart('x_result_found', 'Search result: :count results found for :key', ['key'=>strip_tags(htmlspecialchars(\Request::get('q'))),'count'=>$results->count()]) !!}</h1>
                    @foreach($results as $result)
                        @if(isset($result->page_sitemap_id) && $result->page_sitemap_id == PRODUCT_ST_ID)
                            @php
                                $brandPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', BRANDS_ST_ID)->where('cint_1', $result->brand)->first();
                                if( $brandPage ){
                                    $brandTitle = $brandPage->detail->name;
                                }else{
                                    $brandPage = false;
                                }
                            @endphp
                        @else
                            @php $brandPage = false; @endphp
                        @endif
                        <div class="serach-item">
                            @if(isset($result->page_sitemap_id))
                                @if( !is_null($result->cover_detail_image_id) )
                                    <div class="img">
                                        <img src="{!! resizeImage(image($result->cover_detail_image_id)->url,['w'=>250]) !!}" />
                                    </div>
                                @elseif( !is_null($result->cover_image_id) )
                                    <div class="img">
                                        <img src="{!! resizeImage(image($result->cover_image_id)->url, ['w'=>250]) !!}" />
                                    </div>
                                @elseif( $result->page_sitemap_id == PRODUCT_ST_ID )
                                    @php
                                        $decor_image = 'assets/img/decors/'. str_replace(" ", "", $result->decor_code).'.jpg';
                                        if( \File::exists(public_path($decor_image)) ){
                                            $decor_image = asset($decor_image);
                                        }else{
                                            $decor_image = $settings->f_default_decor ? image($settings->f_default_decor)->originalUrl : asset('img/default.jpg');
                                        }
                                    @endphp
                                    <div class="img">
                                        <img src="{!! resizeImage($decor_image, ['w'=>250]) !!}" />
                                    </div>

                                @endif

                            @endif
                           <div class="txt">
                               <h3>{!! $result->title !!}</h3>

                               @if($result->description)
                                   <p>{!! \Str::limit(strip_tags($result->description), 150) !!}</p>
                               @endif
                               @if( $brandPage )
                                   <p>{!! $brandTitle !!} - {!! $result->decor_code !!}</p>
                               @endif
                               <a href="{!! url($result->detail_url) !!}" class="btn white">{!! LangPart('more', 'More') !!}</a>
                           </div>
                        </div>
                    @endforeach
                    <div class="pagerBox">
                       {!! $results->appends(request()->input())->links() !!}
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection
