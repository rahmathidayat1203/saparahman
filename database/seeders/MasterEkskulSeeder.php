<?php

namespace Database\Seeders;

use App\Models\Master_Ekskul;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterEkskulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            Master_Ekskul::create([
                'nama_ekskul'  => 'Santri' . $i,
                'created_by' => "1"
            ]);

    }
}
}
