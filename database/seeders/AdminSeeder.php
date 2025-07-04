<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            Admin::create([
                'nama_admin'  => 'admin' . $i,
                'username' => "adminihboss",
                'email' => "adminbos@gmail.com",
                'password' => "Adm123*",
                'created_by' => "1"
            ]);
        }

    }
}
