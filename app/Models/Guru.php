<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $guarded = ['id'];
    public function kelas(){
        return $this->hasOne(Kelas::class,'id','id_kelas');
    }
    
    public function creator(){
        return $this->hasOne(User::class,'id','created_by');
    }
}
