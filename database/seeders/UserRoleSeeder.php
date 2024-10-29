<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Membuat Role default jika belum ada
        $role = Role::firstOrCreate(['name' => 'kurikulum']);

        // Ambil pengguna, dengan ID 1 sebagai contoh
        $user = User::find(1); // Ubah sesuai kebutuhan

        // Berikan role ke pengguna
        $user->assignRole($role);
    }
}
