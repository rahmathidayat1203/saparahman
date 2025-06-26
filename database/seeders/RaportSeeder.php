<?php

namespace Database\Seeders;

use App\Models\Raport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RaportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            Raport::create([
                'id_santri'  => "1" . $i,
                'id_guru' => "1",
                'id_kelas' => "1",
                'semester' => "1", 
                'created_by' => "1"
            ]);
        }

    }
}
