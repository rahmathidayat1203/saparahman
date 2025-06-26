<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    protected $guarded = ['id'];
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function mapel_kelas()
    {
        return $this->hasMany(mapel_kelas::class, 'tingkatan_kelas', 'tingkat_kelas');
    }
}
