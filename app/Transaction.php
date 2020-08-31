<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction_registration';
    protected $fillable = ['binusian_id','shift_id','anak_ke', 'created_at'];
}
