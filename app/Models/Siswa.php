<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'gender',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'tanggal_masuk',
        'status',
        'id_kelas' // Foreign key ke tabel kelas
    ];

    // Jika Anda ingin menambahkan relasi
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    // Tambahan jika ingin mendefinisikan relasi ke tabel lainnya
}
