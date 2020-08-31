<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anak extends Model
{
    protected $table ='master_data_anak_pegawai';
    
    public function Age(){
        //return $this->tanggal_lahir->diffInYears(\Carbon::now());
        return Carbon::parse($this->attributes['tanggal_lahir'])->age;
    }

}
