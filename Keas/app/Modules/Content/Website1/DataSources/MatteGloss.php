<?php

namespace App\Modules\Content\Website1\DataSources;

use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\DataSource;

class MatteGloss extends DataSource
{
    public function getData()
    {
        return Cache::rememberForever(hash('md5', 'MediapressMatteGloss' ), function () {
            $data[1] = 'Matte';
            $data[2] = 'Gloss';
            return $data;
        });
    }
}
