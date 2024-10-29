<?php

namespace App\Imports;

use App\Models\Kenaikan;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KenaikanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Anda dapat menyesuaikan nama kolom di Excel dengan field yang ada di database
        return new Kenaikan([
            'id_siswa'     => Siswa::where('nama', $row['nama_siswa'])->first()->id ?? null, // misalnya match nama siswa
            'tahun_ajaran' => $row['tahun_ajaran'],
            'kelas_asal'   => $row['kelas_asal'],
            'kelas_tujuan' => $row['kelas_tujuan'],
        ]);
    }
}
