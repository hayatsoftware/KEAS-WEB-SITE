<?php

namespace App\Modules\Content\Website1\DataSources;

use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\DataSource;

class DoorPanelSurfaces extends DataSource
{
    public function getData()
    {
        return Cache::rememberForever(hash('md5', 'MediapressDoorPanelSurfaces' ), function () {
            $data = [];
            $pages = \DB::table('pages')
                ->select('pages.id', 'page_details.name')
                ->join('page_details', function($join){
                    $join->on('page_details.page_id', '=', 'pages.id')
                        ->where(function($query){
                            return $query->where('page_details.name', '!=', NULL)
                                ->where('page_details.name', '<>', '')
                                ->where('page_details.language_id', 616)
                                ->where('page_details.name', '!=', '-');
                        })
                        ->where('page_details.language_id', 616)
                        ->where('page_details.deleted_at', NULL);
                })
                ->where('pages.sitemap_id', DOOR_PANEL_SURFACES_ST_ID)
                ->where('pages.status', 1)
                ->get();
            foreach($pages as $page){
                $data[$page->id] = $page->name;
            }
            return $data;
        });
    }
}
