<?php

namespace Database\Seeders;

use App\Models\Kasus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KasusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            Kasus::create([
                'jenis_pelanggaran'  => 'pelanggaran' . $i,
                'tgl_kejadian' => "22 april 2025",
                'ket_pelanggaran' => "tidak sholat",
                'desc_penyelesaian' => "hafalan juz 30",
                'id_jenis_kasus' => "1",
                'id_santri' => "1",
                'created_by' => "1"
            ]);
        }
    }
}
