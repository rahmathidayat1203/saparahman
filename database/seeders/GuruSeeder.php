<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            Guru::create([
                'nama_guru'  => 'guru' . $i,
                'username' => "laelidewi",
                'email' => "laelidewi100@gmail.com",
                // 'password' => "Lzbbxncy180603*",
                'id_kelas' => "1",
                'created_by' => "1"
            ]);
        }
    }
}
