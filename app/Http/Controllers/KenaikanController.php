<?php

namespace App\Http\Controllers;

use App\Exports\KenaikanSiswaExport;
use App\Imports\KenaikanImport;
use App\Models\Kelas;
use App\Models\Kenaikan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KenaikanController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Kelas::all();

        $search = $request->input('search');
        $query = Kenaikan::with('siswa');
        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                    ->orWhere('id_siswa', 'like', '%' . $search . '%')
                    ->orWhere('tahun_ajaran', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('kelas_asal')) {
            $query->where('kelas_asal', $request->kelas_asal);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $kenaikan = $query->get();

        return view('kenaikan.index', compact('kenaikan', 'kelas'));
    }


    public function create()
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        return view('kenaikan.create', compact('siswa', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswas,id',
            'tahun_ajaran' => 'required|string|max:20',
            'kelas_asal' => 'required|exists:kelas,id',
            'kelas_tujuan' => 'required|exists:kelas,id',
        ]);

        Kenaikan::create($request->all());
        return redirect()->route('kenaikan.index')->with('success', 'Kenaikan berhasil ditambahkan');
    }

    public function edit(Kenaikan $kenaikan)
    {
        return view('kenaikan.edit', compact('kenaikan'));
    }

    public function update(Request $request, Kenaikan $kenaikan)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswas,id',
            'tahun_ajaran' => 'required|string|max:20',
            'kelas_asal' => 'required|exists:kelas,id',
            'kelas_tujuan' => 'required|exists:kelas,id',
        ]);

        $kenaikan->update($request->all());
        return redirect()->route('kenaikan.index')->with('success', 'Kenaikan berhasil diperbarui');
    }

    public function destroy(Kenaikan $kenaikan)
    {
        $kenaikan->delete();
        return redirect()->route('kenaikan.index')->with('success', 'Kenaikan berhasil dihapus');
    }

    public function export(Request $request)
    {
        $tahunAjaran = $request->input('tahun_ajaran');
        $kelasAsal = $request->input('kelas_asal');
        $kelasTujuan = $request->input('kelas_tujuan');

        return Excel::download(new KenaikanSiswaExport($tahunAjaran, $kelasAsal, $kelasTujuan), 'kenaikan.xlsx');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new KenaikanImport, $request->file('file'));

            return redirect()->back()->with('success', 'Berhasil');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Error: ' . $e->getMessage());
        }
    }
}
