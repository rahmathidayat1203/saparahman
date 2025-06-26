<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Pengumuman
            'pengumuman-list',
            'pengumuman-create',
            'pengumuman-edit',
            'pengumuman-delete',

            // Data Identitas
            'identitas-list',
            'identitas-create',
            'identitas-edit',
            'identitas-delete',

            // Data Pembelajaran
            'pembelajaran-list',
            'pembelajaran-create',
            'pembelajaran-edit',
            'pembelajaran-delete',

            // e-Raport
            'raport-list',
            'raport-create',
            'raport-edit',
            'raport-delete',

            // Data Kasus
            'kasus-list',
            'kasus-create',
            'kasus-edit',
            'kasus-delete',

            // Subjek Hafalan
            'subjekhafalan-list',
            'subjekhafalan-create',
            'subjekhafalan-edit',
            'subjekhafalan-delete',

            // Catatan Hafalan
            'catatanhafalan-list',
            'catatanhafalan-create',
            'catatanhafalan-edit',
            'catatanhafalan-delete',

            // e-Mading
            'emading-list',
            'emading-create',
            'emading-edit',
            'emading-delete',

            // Kalender Akademik
            'kalender-list',
            'kalender-create',
            'kalender-edit',
            'kalender-delete',

            // Peraturan
            'peraturan-list',
            'peraturan-create',
            'peraturan-edit',
            'peraturan-delete',

            // Chat
            'chat-list',
            'chat-create',
            'chat-edit',
            'chat-delete',

            // Role management (opsional jika pakai manajemen role)
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            // Nilai Ekskul
            'nilai-ekskul-create',
            'nilai-ekskul-edit',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
