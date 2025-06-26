<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ortu_santri extends Model
{
    protected $guarded = ['id'];

    public function santri(){
        return $this->belongsTo(Santri::class,'id_santri','id');
    }
}
