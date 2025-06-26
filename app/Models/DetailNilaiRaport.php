<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailNilaiRaport extends Model
{
    protected $guarded = ['id'];
    protected $table = "detail_nilai_raports";
    public function mapel_kelas()
    {
        return $this->belongsTo(mapel_kelas::class, 'id_mapel_kelas');
    }
    public function raport()
    {
        return $this->belongsTo(Raport::class, 'id_raport');
    }

    public function mapel(){
        return $this->hasOne(Master_Mapel::class,'id','id_mapel');
    }

}
