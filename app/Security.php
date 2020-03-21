<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    protected $table = 'security';
    public $timestamps = false;

    protected $fillable = ['user_id', 'active', 'last_activity', 'session_date', 'security_key'];

}
