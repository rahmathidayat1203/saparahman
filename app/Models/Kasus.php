<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    protected $guarded = ['id'];
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }

    public function jenisKasus()
    {
        return $this->belongsTo(jenis_kasus::class, 'id_jenis_kasus');
    }
}
