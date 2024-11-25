<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalePoints extends Model
{
    protected $table = 'sale_points';
    protected $guarded = [];

    public function extras()
    {
        return $this->hasMany(SalePointExtras::class);
    }
}
