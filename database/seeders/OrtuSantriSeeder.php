<?php

namespace Database\Seeders;

use App\Models\orang_tua;
use App\Models\ortu_santri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrtuSantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 15; $i++) {
            $orangTua = orang_tua::create([
                'nama_ortu'   => "Dewi Laeli{$i}",
                'no_kk'       => '3174075806000' . rand(10, 99),
                'no_telepon'  => '0851741887' . rand(10, 99),
                'alamat'      => 'Jalan Sentosa Lorong Asli II RT.015 RW. 004',
                'pekerjaan'   => 'Wirausaha',
                'foto'        => 'default.jpg', // tambahkan ini agar tidak error
                'created_by'  => 1,
                'updated_by'  => 1,
            ]);

            ortu_santri::create([
                'id_ortu'     => $orangTua->id,
                'id_santri'   => 1223, // ubah jika perlu acak
                'created_by'  => 1,
                'updated_by'  => 1
            ]);
        }
    }
}
