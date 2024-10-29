<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Kenaikan;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();
        $jumlahKenaikan = Kenaikan::count();

        return view('dashboard.index', compact('jumlahSiswa', 'jumlahKelas', 'jumlahKenaikan'));
    }
}
