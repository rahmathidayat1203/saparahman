<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HafalanSurah extends Model
{
    protected $guarded = ['id'];
    protected $table = "hafalan_surah";
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }

    public function surah()
    {
        return $this->belongsTo(Surah::class, 'id_surah');
    }
}
