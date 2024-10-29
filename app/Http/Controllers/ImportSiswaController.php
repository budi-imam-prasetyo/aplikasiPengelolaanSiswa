<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport; // Import kelas yang kita buat untuk menghandle data import
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportSiswaController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls' // Validasi file
        ]);

        Excel::import(new SiswaImport, $request->file('file')); // Import file

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diimpor!');
    }
}
