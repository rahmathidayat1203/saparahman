<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRaportP5 extends Model
{
    protected $guarded = ['id'];
    protected $table = "detail_raport_p5_s";
    public function raport()
    {
        return $this->belongsTo(Raport::class, 'id_raport');
    }
}
