<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        Siswa::create([
            'nama' => 'Budi',
            'gender' => 'L',
            'tanggal_lahir' => '2005-03-21',
            'alamat' => 'Jl. Raya No. 1',
            'no_telepon' => '08123456789',
            'tanggal_masuk' => '2023-01-15',
            'status' => 'Aktif',
            'id_kelas' => 1 // Pastikan kelas dengan ID ini sudah ada
        ]);

        Siswa::create([
            'nama' => 'Siti',
            'gender' => 'P',
            'tanggal_lahir' => '2005-04-22',
            'alamat' => 'Jl. Raya No. 2',
            'no_telepon' => '08123456780',
            'tanggal_masuk' => '2023-01-15',
            'status' => 'Aktif',
            'id_kelas' => 1 // Pastikan kelas dengan ID ini sudah ada
        ]);

        // Anda bisa menambahkan siswa lainnya sesuai kebutuhan
    }
}
