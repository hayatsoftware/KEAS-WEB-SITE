<?php

namespace App\Modules\Content\Website1\DataSources;

use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\DataSource;
use Mediapress\Modules\Content\Models\Page;

class ParkeClasses extends DataSource
{
    public function getData()
    {
        return Cache::rememberForever(hash('md5', 'MediapressParkeClasses' ), function () {
            $data = [];
            $values = Page::where('sitemap_id', PARKE_CLASSES_ST_ID)->get()->pluck('cvar_1');
            foreach($values as $value){
                $data[$value] = $value;
            }
            return $data;
        });
    }
}
