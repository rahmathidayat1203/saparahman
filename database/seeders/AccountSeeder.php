<?php

namespace Database\Seeders;

use App\Models\orang_tua;
use App\Models\ortu_santri;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>"rahmat",
            "no_wa" => "089506729007",
            "password" => bcrypt("12345678")
        ]);

        orang_tua::create([
            'nama_ortu' => $user->name,
            'no_kk' => "091231312",
            'no_telepon' => $user->no_wa,
            'alamat' => "alamat palsuu",
            'pekerjaan' => "badut jalanan",
            'created_by' =>1
        ]);

        
    }
}
