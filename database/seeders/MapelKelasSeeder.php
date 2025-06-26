<?php

namespace Database\Seeders;

use App\Models\mapel_kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapelKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            mapel_kelas::create([
                'tingkat_kelas'  => 'MA' . $i,
                'id_master_mapel' => "1",
                'created_by' => "1"
            ]);
        }

    }
}
