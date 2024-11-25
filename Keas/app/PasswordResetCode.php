<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordResetCode extends Model
{
    const UPDATED_AT = null;

    protected $table = 'password_reset_codes';
    protected $guarded = [];
    public $timestamps = [ "created_at" ];

}
