<?php

namespace App\Modules\Content\Website1\DataSources;

use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\DataSource;

class YouDesigns extends DataSource
{
    public function getData()
    {
        return Cache::rememberForever(hash('md5', 'MediapressMatteGloss' ), function () {
            $data[1] = 'Default';
            $data[2] = '3D Cartela';
            $data[3] = 'Virtual Room';
            $data[4] = 'See In Your Room';
            return $data;
        });
    }
}
