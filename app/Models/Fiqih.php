<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fiqih extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fiqih';

    protected $fillable = [
        'jenis_fiqih',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
