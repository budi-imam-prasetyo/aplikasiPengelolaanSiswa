<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class SiswaImport implements ToModel, WithHeadings
{
    public function model(array $row)
    {
        return new Siswa([
            'nama'          => $row[0],
            'gender'        => $row[1],
            'tanggal_lahir' => $this->convertDate($row[2]), // Converts date
            'alamat'        => $row[3],
            'no_telepon'    => $row[4],
            'tanggal_masuk' => $this->convertDate($row[5]), // Converts date
            'status'        => $row[6],
            'id_kelas'      => $row[7], // Pastikan ID kelas ini sesuai dengan kelas yang ada
        ]);
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Gender',
            'Tanggal Lahir',
            'Alamat',
            'No Telepon',
            'Tanggal Masuk',
            'Status',
            'ID Kelas',
        ];
    }

    private function convertDate($date)
    {
        // Mengonversi tanggal ke string format Y-m-d
        if ($date instanceof \DateTime) {
            return $date->format('Y-m-d'); // Konversi ke format string
        }
        
        // Menggunakan Carbon untuk mengonversi dari format Excel atau string
        return $date ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date))->format('Y-m-d') : null;
    }
}
