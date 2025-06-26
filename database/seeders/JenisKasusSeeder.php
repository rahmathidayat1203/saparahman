<?php

namespace Database\Seeders;

use App\Models\jenis_kasus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKasusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            jenis_kasus::create([
                'jenis_kasus'  => 'peribadatan' . $i,
                'created_by' => "1"
            ]);
        }

    }
}
