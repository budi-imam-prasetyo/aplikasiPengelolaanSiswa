<?php

   namespace Database\Seeders; // Pastikan ini adalah namespace yang benar

   use Illuminate\Database\Seeder;
   use Spatie\Permission\Models\Role;
   use Spatie\Permission\Models\Permission;

   class RoleAndPermissionSeeder extends Seeder
   {
       public function run()
       {
           // Buat Role Kurikulum
           Role::create(['name' => 'kurikulum']);

           // Permissions yang diperlukan
           Permission::create(['name' => 'view siswa']);
           Permission::create(['name' => 'create siswa']);
           Permission::create(['name' => 'update siswa']);
           Permission::create(['name' => 'view kelas']);
           Permission::create(['name' => 'update kelas']);
           Permission::create(['name' => 'view kenaikan']);
           Permission::create(['name' => 'create kenaikan']);
           Permission::create(['name' => 'update kenaikan']);

           // Menetapkan permission ke role kurikulum
           $role = Role::findByName('kurikulum');
           $role->givePermissionTo(['view siswa', 'create siswa', 'update siswa', 'view kelas', 'update kelas', 'view kenaikan', 'create kenaikan', 'update kenaikan']);
       }
   }
