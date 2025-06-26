<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HafalanFiqih extends Model
{
    protected $guarded = ['id'];
    protected $table = "hafalan_fiqih";

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }

    public function fiqih()
    {
        return $this->belongsTo(Fiqih::class, 'id_fiqih');
    }
}
