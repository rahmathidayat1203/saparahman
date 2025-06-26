<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mading extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mading';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(KategoriMading::class, 'id_kategori_mading');
    }
    public function asas()
    {
        return $this->belongsTo(MasterAsas::class, 'id_asas');
    }
}
