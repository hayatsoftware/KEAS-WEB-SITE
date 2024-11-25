<?php

namespace App\Modules\Content\Website1\DataSources;

use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\DataSource;

class ClassificationList extends DataSource
{
    public function getData()
    {
        return Cache::rememberForever(hash('md5', 'MediapressClassificationList' ), function () {
            $data[1] = 'List 1';
            $data[2] = 'List 2';
            $data[3] = 'List 3';
            return $data;
        });
    }
}
