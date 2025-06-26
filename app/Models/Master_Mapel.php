<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_Mapel extends Model
{
    protected $guarded = ['id'];

    public function master_mapel()
    {
        return $this->belongsTo(Master_Mapel::class, 'id_master_mapel');
    }
}
