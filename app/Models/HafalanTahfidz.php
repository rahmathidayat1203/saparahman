<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HafalanTahfidz extends Model
{
    use SoftDeletes;

    protected $table = "hafalan_tahfidz";

    // Gunakan hanya salah satu dari guarded atau fillable (gunakan fillable seperti sekarang)
    protected $fillable = [
        'id_santri',
        'id_tahfidz',
        'tgl_setoran',
        'nilai',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // Relasi ke tabel santri
    public function santri()
    {
        return $this->hasOne(Santri::class, 'id','id_santri');
    }

    // Relasi ke tabel tahfidz
    public function tahfidz()
    {
        return $this->hasOne(Tahfidz::class,'id','id_tahfidz');
    }
}
