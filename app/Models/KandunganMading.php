<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KandunganMading extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = ['id'];
    protected $table = "kandungan_mading";

    public function asas()
    {
        return $this->belongsTo(MasterAsas::class, 'id_asas');
    }
}
