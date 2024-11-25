<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmCatalogue extends Model
{
    protected $table = 'crm_catalogues';
    protected $guarded = [];

    protected $casts = [
        'catalogues' => 'array',
    ];
}
