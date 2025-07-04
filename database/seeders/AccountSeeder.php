<?php

namespace Database\Seeders;

use App\Models\orang_tua;
use App\Models\ortu_santri;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user
        $user = User::create([
            'name'     => 'Rahmat',
            'no_wa'    => '089506729007',
            'password' => Hash::make('12345678'), // lebih baik daripada bcrypt langsung
        ]);

        // Membuat data orang tua dari data user
        orang_tua::create([
            'nama_ortu'   => $user->name,
            'no_kk'       => '091231312',
            'no_telepon'  => $user->no_wa,
            'alamat'      => 'alamat palsuu',
            'pekerjaan'   => 'badut jalanan',
            'foto'        => 'default.jpg', // hindari error foto not null
            'created_by'  => 1,
            'updated_by'  => 1,
        ]);
    }
}
