<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_ekskul_raport extends Model
{
    protected $guarded = ['id'];

    public function raport()
    {
        return $this->belongsTo(Raport::class, 'id_raport');
    }

    public function ekskul()
    {
        return $this->belongsTo(\App\Models\Master_Ekskul::class, 'id_ekskul');
    }
}
