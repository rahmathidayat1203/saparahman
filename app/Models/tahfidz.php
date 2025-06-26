<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tahfidz extends Model
{
    use SoftDeletes;

    protected $table = 'tahfidz';

    protected $fillable = [
        'jenis_tahfidz',
        'arti',
        'juz_ayat',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
