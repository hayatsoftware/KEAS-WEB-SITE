<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmSubscriptions extends Model
{
    protected $table = 'crm_subscriptions';
    protected $guarded = [];

    protected $casts = [
        'products' => 'array',
    ];
}
