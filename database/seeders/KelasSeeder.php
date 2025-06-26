<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i=0; $i < 15; $i++) { 
        //     Kelas::create([
        //         'tingkatan'  => 'Madrasah Aliyah' . $i,
        //         'tingkat_kelas' => "10",
        //         'nama_kelas' => "A",
        //         'created_by' => "1"
        //     ]);
        // }

        DB::table('kelas')->insert([
            
            'tingkatan' => 'Madrasah Aliyah',
            'tingkat_kelas' => "10",
            'nama_kelas' => 'X.A',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
