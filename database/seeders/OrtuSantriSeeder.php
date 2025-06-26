<?php

namespace Database\Seeders;

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
        for ($i=0; $i < 15; $i++) { 
            ortu_santri::create([
                'id_ortu'  => "1",
                'id_santri' => "1223",
                'created_by' => "1",
                'updated_by' => "1"
            ]);
        }
    }
}
