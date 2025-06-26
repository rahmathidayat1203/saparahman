<?php

namespace Database\Seeders;

use App\Models\Santri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i = 0; $i < 15; $i++) {
        //     Santri::create([
        //         'nama_santri' => 'Santri' . $i,
        //         'nis' => 'NIS' . rand(10000, 99999),
        //         'nisn' => 'NISN' . rand(1000000, 9999999),
        //         'nsm' => 'NSM' . rand(1000, 9999),
        //         'npsm' => 'NPSM' . rand(1000, 9999),
        //         'gender' => $i % 2 == 0 ? 'santriwan' : 'santriwati',
        //         'id_kelas' => 1, // pastikan kelas dengan ID 1 sudah ada
        //         'created_by' => 1,
        //         'updated_by' => null,
        //         'deleted_by' => null,
        //     ]);
        // }

        $idKelas = DB::table('kelas')->inRandomOrder()->value('id');

        DB::table('kelas')->insert([
            'nama_kelas' => 'X.A',
            'tingkatan' => 'X', // sesuaikan dengan field aslinya
            'tingkat_kelas' => '10',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

        for ($i = 0; $i < 15; $i++) {
            Santri::create([
                'nama_santri' => 'Santri' . $i,
                'nis' => 'NIS' . rand(10000, 99999),
                'nisn' => 'NISN' . rand(1000000, 9999999),
                'nsm' => 'NSM' . rand(1000, 9999),
                'npsm' => 'NPSM' . rand(1000, 9999),
                'gender' => $i % 2 == 0 ? 'santriwan' : 'santriwati',
                'id_kelas' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
            ]);
        }
    }
}
