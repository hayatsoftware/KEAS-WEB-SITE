<?php

namespace App\Modules\Content\Website1\DataSources;

use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\DataSource;

class SustainabilityPages extends DataSource
{
    public function getData()
    {
        return Cache::rememberForever(hash('md5', 'MediapressSustainabilityPages' ), function () {
            $data[0] = 'Choose';
            $data[1] = 'Innovation & Ar-ge Page';
            $data[2] = 'Quality';
            $data[3] = 'Environment';
            return $data;
        });
    }
}
