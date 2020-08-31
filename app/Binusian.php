<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Binusian extends Model
{
    protected $table = 'master_user';
    
    protected $fillable = ['binusian_id','password'];
}
