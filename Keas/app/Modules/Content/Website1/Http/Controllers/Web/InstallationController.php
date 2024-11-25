<?php

namespace App\Modules\Content\Website1\Http\Controllers\Web;

use Illuminate\Http\Request;
use Mediapress\Http\Controllers\BaseController;
use Mediapress\Foundation\Mediapress;

class InstallationController extends BaseController
{

    public function SitemapDetail(Mediapress $mediapress) {
        $document_data = [];
        $documents = self::getDocuments($mediapress);
        if($documents->isNotEmpty()){
            foreach($documents as $page){
                if(!is_null($page->document_id)){
                    $file = get_image_path($page->document_id);
                    $document_data[] = [
                        'name' => strip_tags($page->name),
                        'file' => asset($file),
                        'size' => filesize_text(filesize($file))
                    ];
                }

            }
        }
        $mediapress->data['documents'] = $document_data;
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
                'document.mfile_id as document_id'
            )
            ->join('page_details', function($join)use($mediapress){
                $join->on('page_details.page_id', '=', 'pages.id')->whereNotNull('page_details.name')
                    ->where('page_details.language_id', $mediapress->activeLanguage->id)
                    ->where('page_details.country_group_id', $mediapress->activeCountryGroup->id)
                    ->where('page_details.deleted_at', NULL)
                    ->where('page_details.name', '<>', '');
            })
            ->leftJoin('mfile_general as document', function($join){
                $join->on('document.model_id', '=', 'page_details.id')
                    ->where('document.file_key', 'document')
                    ->where('document.model_type', 'Mediapress\Modules\Content\Models\PageDetail');
            })
            ->where('pages.sitemap_id', DOCUMENT_ST_ID)
            ->where('pages.status', 1)
            ->where('pages.cint_2', 1)
            ->orderBy('pages.order')
            ->get();
    }


}
