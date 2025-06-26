<?php

namespace Database\Seeders;

use App\Models\Master_Mapel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterMapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            Master_Mapel::create([
                'nama_mapel'  => 'Fiqih' . $i,
                'created_by' => "1"
            ]);
        }
    }
}
