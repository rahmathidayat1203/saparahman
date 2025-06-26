<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $guarded = ['id'];
    protected $table = 'santris';

    public function kelas(){
        return $this->hasOne(Kelas::class,'id','id_kelas');
    }
    
}
