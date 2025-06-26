<?php

namespace Database\Seeders;

use App\Models\detail_ekskul_raport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailEkskulRaportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            detail_ekskul_raport::create([
                'id_raport' => "1",
                'id_ekskul' => "1",
                'nilai' => "1223",
                'created_by' => "1"
            ]);
        }
    }
}
