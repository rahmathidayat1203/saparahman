<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HafalanArab extends Model
{
    protected $guarded = ['id'];
    protected $table = "hafalan_arab";

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }

    public function arab()
    {
        return $this->belongsTo(Arab::class, 'id_arab');
    }
}
