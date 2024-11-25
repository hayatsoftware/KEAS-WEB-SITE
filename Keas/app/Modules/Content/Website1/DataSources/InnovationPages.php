<?php

namespace App\Modules\Content\Website1\DataSources;

use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\DataSource;

class InnovationPages extends DataSource
{
    public function getData()
    {
        return Cache::rememberForever(hash('md5', 'MediapressInnovationPages' ), function () {
            $data[1] = 'Default Layout (Photo Gallery Requires)';
            $data[2] = 'Listing Layout (Sub Pages Require)';
            $data[3] = 'Left & Right Listing Layout (Sub Pages Require)';
            return $data;
        });
    }
}
