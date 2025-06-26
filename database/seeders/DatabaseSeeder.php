<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OrangTuaSeeder::class,
            OrtuSantriSeeder::class,
            GuruSeeder::class,
            AdminSeeder::class,
            KasusSeeder::class,
            JenisKasusSeeder::class,
            KelasSeeder::class,
            MasterMapelSeeder::class,
            MapelKelasSeeder::class,
            MasterEkskulSeeder::class,
            DetailEkskulRaportSeeder::class,
            RaportSeeder::class,
            AccountSeeder::class,
            SantriSeeder::class,
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class
        ]);
    }
}
