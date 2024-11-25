<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmInfo extends Model
{
    protected $table = 'crm_info';
    protected $guarded = [];

    protected $casts = [
        'request' => 'array',
        'response' => 'array'
    ];
}
