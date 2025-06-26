<?php

namespace Database\Seeders;

use App\Models\orang_tua;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            orang_tua::create([
                'nama_ortu'  => 'Dewi Laeli' . $i,
                'no_kk' => "31740758060003",
                'no_telepon' => "085174188759",
                'alamat' => "Jalan Sentosa Lorong Asli II RT.015 RW. 004",
                'pekerjaan' => "Wirausaha",
                'created_by' => "1"
            ]);
        }
    }
}