<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = ['id'];
    public function mapel_kelas()
    {
        return $this->hasMany(mapel_kelas::class, 'tingkatan_kelas', 'tingkatan');
        // pastikan 'tingkatan' adalah kolom di tabel kelas
    }
}
