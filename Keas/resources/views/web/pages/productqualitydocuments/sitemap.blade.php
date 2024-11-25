@php
    $categories = \Mediapress\Modules\Content\Models\Category::where('sitemap_id', $sitemap_id)
    ->whereHas('details', function($query)use($mediapress){
        return $query->where('country_group_id', $mediapress->activeCountryGroup->id)->where('language_id', $mediapress->activeLanguage->id);
    })
    ->where('status', 1)
    ->where('category_id', 0)
    ->orderBy('lft')
    ->get();
@endphp
<div class="tabs">
    <div class="mob_tab">
        <span>TSE</span> <i class="far fa-chevron-down"></i>
    </div>
    <ul id="tabs-nav">
        @foreach($categories as $category)
            @if($category->detail)
                <li><a href="#{!! \Str::slug($category->detail->name, '-') !!}">{!! $category->detail->name !!} </a></li>
            @endif
        @endforeach
    </ul> <!-- END tabs-nav -->
</div>
<div id="tabs-content">
    @foreach( $categories as $category )
        @if( $category->detail )
        <div id="{!! \Str::slug($category->detail->name, '-') !!}" class="tab-content">
            @if( $category->children->isNotEmpty() )
                @foreach( $category->children as $children )
                    @if($children->detail)
                        <div class="block">
                            <div class="head">{!! $children->detail->name !!} </div>
                            @if( $children->pages->isNotEmpty() )
                            <div class="documents">
                                @php
                                    $pages = $children->pages()->whereHas('details', function($query)use($mediapress){
                                        return $query->where('language_id', $mediapress->activeLanguage->id)
                                            ->where('country_group_id', $mediapress->activeCountryGroup->id)
                                            ->where(function($q){
                                                return $q->where('name', '!=', '');
                                            });
                                    })->get();
                                @endphp
                                @foreach($children->pages as $page)
                                    @if( $page->detail )
                                    <a href="{!! strip_tags(image($page->detail->f_document)) !!}">
                                        {!! $page->detail->name !!}
                                        @if( $page->detail->f_document )
                                        <div class="rights">
                                            <small>{!! filesize_text($page->detail->f_document->size) !!}</small>
                                            <span>{!! LangPart('download', 'Download') !!}</span>
                                        </div>
                                        @endif
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        @endif
    @endforeach
</div>
