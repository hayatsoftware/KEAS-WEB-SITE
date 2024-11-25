<?php

namespace App\Modules\Content\Website1\DataSources;

use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\DataSource;

class Dimensions extends DataSource
{
    public function getData()
    {
        return Cache::rememberForever(hash('md5', 'MediapressDimensions' ), function () {
            $data = [];
            $pages = \DB::table('pages')
                ->select('pages.id', 'pages.cvar_1')
                ->where('pages.sitemap_id', 24)
                ->where('pages.status', 1)
                ->orderBy('cvar_1')
                ->whereNull('deleted_at')
                ->get();
            foreach($pages as $page){
                $data[$page->id] = $page->cvar_1;
            }
            return $data;
        });
    }
}