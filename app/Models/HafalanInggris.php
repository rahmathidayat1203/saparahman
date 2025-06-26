<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HafalanInggris extends Model
{
    use SoftDeletes;

    protected $table = 'hafalan_inggris';

    protected $fillable = [
        'id_santri',
        'id_inggris',
        'tgl_setoran',
        'nilai',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }

    public function inggris()
    {
        return $this->belongsTo(Inggris::class, 'id_inggris');
    }
}
