<?php

namespace App\Modules\Content\Website1\DataSources;

use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\DataSource;

class QualityPages extends DataSource
{
    public function getData()
    {
        return Cache::rememberForever(hash('md5', 'MediapressQualityPages' ), function () {
            $data[0] = 'Default Layout';
            $data[1] = 'Product Quality Page Layout';
            $data[2] = 'Quality Statements Page Layout';
            $data[3] = 'Warranty Documents Page Layout';
            $data[4] = 'Our Policies Page Layout';
            $data[5] = 'Our Documents Page Layout';
            return $data;
        });
    }
}
