<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arab extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'arab';

    protected $fillable = [
        'subjek',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
