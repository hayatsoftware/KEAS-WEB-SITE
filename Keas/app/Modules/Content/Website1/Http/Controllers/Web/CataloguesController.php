<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\Page;

class CataloguesController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {

        $documentNonCategoriesPages = self::getDocuments($mediapress);
        $catalogue_data = [];
        $catalogue_collect = [];
        if($documentNonCategoriesPages->isNotEmpty()){
            $catalogue_data[0]['name'] = strip_tags(LangPart('general', 'General'));
            foreach($documentNonCategoriesPages as $page){
                if(!is_null($page->document_id)){
                    $catalogue_data[0]['files'][] = [
                        'type' => !is_null($page->file_embed) ? 'embed':'file',
                        'name' => strip_tags($page->name),
                        'file' => !is_null($page->file_embed) ? $page->file_embed:get_image($page->document_id),
                        'cover' => !is_null($page->cover_id) ? get_image($page->cover_id) : (!is_null($page->cover_main_id) ? get_image($page->cover_main_id) : asset('images/default.jpg'))
                    ];
                }

            }
        }
        foreach($catalogue_data as $data){
            if(isset($data['files'])){
                $catalogue_collect[] = $data;
            }
        }

        $catalogue_data = [];
        $categories = Category::where('sitemap_id', PRODUCT_ST_ID)
            ->whereHas('details', function($query)use($mediapress){
                return $query->where('language_id', $mediapress->activeLanguage->id)
                    ->where('country_group_id', $mediapress->activeCountryGroup->id)
                    ->where(function($q){
                        return $q->where('name', '!=', '')->orWhere('name', '!=', '-');
                    });
            })
            ->whereIn('category_id', [1,15])
            ->where('status', 1)
            ->get();
        foreach( $categories as $key => $category ){
            $category_ids = [$category->id];
            $children_categories = $category->children->pluck('id');
            foreach( $children_categories as $child ){
                array_push($category_ids, $child);
            }
            $documentPages = Page::where('sitemap_id', DOCUMENT_ST_ID)
                ->whereHas('extras', function($query)use($category_ids){
                    return $query->where('key', 'category_document_list')->whereIn('value', $category_ids);
                })
                ->where('cint_1', 1)
                ->where('status', 1)
                ->orderBy('order')
                ->get();
            if($documentPages->isNotEmpty()){
                $catalogue_data[$key]['name'] = strip_tags($category->detail->name);
                foreach($documentPages as $page){
                    if($page->detail->f_document || !empty(strip_tags($page->detail->file_embed))){
                        $catalogue_data[$key]['files'][] = [
                            'id' => $page->id,
                            'type' => !empty(strip_tags($page->detail->file_embed)) ? 'embed':'file',
                            'name' => strip_tags($page->detail->name),
                            'file' => !empty(strip_tags($page->detail->file_embed)) ? strip_tags($page->detail->file_embed) : image($page->detail->f_document)->url,
                            'cover' => $page->detail->f_cover ? image($page->detail->f_cover)->url : image($page->f_cover)->url
                        ];
                    }

                }
            }
            unset($category_ids);
        }

        foreach($catalogue_data as $data){
            if(isset($data['files'])){
                $catalogue_collect[] = $data;
            }
        }


        $mediapress->data['catalogues'] = $catalogue_collect;
		return $this->sitemapDetailFunc([
		]);
	}


    private function getDocuments($mediapress)
    {
        return \DB::table('pages')
            ->select(
                'pages.id',
                'pages.order',
                'page_details.name',
                'page_detail_extras.value as file_embed',
                'page_extras.value',
                'document.mfile_id as document_id',
                'cover.mfile_id as cover_id',
                'cover_main.mfile_id as cover_main_id'
            )
            ->join('page_details', function($join)use($mediapress){
                $join->on('page_details.page_id', '=', 'pages.id')->whereNotNull('page_details.name')
                    ->where('page_details.language_id', $mediapress->activeLanguage->id)
                    ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('page_details.deleted_at', NULL)
                    ->where('page_details.name', '<>', '');
            })
            ->leftJoin('page_extras', function($join){
                $join->on('page_extras.page_id', '=', 'pages.id')
                    ->where('page_extras.key', 'category_document_list');
            })
            ->leftJoin('page_detail_extras', function($join){
                $join->on('page_detail_extras.page_detail_id', '=', 'page_details.id')
                    ->where('page_detail_extras.key', 'file_embed')
                    ->where('page_detail_extras.value', '<>', '');
            })
            ->leftJoin('mfile_general as document', function($join){
                $join->on('document.model_id', '=', 'page_details.id')
                    ->where('document.file_key', 'document')
                    ->where('document.model_type', 'Mediapress\Modules\Content\Models\PageDetail');
            })
            ->leftJoin('mfile_general as cover', function($join){
                $join->on('cover.model_id', '=', 'page_details.id')
                    ->where('cover.file_key', 'cover')
                    ->where('cover.model_type', 'Mediapress\Modules\Content\Models\PageDetail');
            })
            ->leftJoin('mfile_general as cover_main', function($join){
                $join->on('cover_main.model_id', '=', 'pages.id')
                    ->where('cover_main.file_key', 'cover')
                    ->where('cover_main.model_type', 'Mediapress\Modules\Content\Models\Page');
            })
            ->where('pages.sitemap_id', DOCUMENT_ST_ID)
            ->where('pages.status', 1)
            ->where('pages.cint_1', 1)
            ->orderBy('pages.order')
            ->whereNull('page_extras.value')
            ->get();
    }



}
