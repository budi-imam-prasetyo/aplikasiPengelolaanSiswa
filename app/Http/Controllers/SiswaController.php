<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa; // Pastikan ini ada
use App\Models\Kelas; // Pastikan model Kelas diimpor
use App\Models\Kenaikan; // Jika Anda menggunakan model Kenaikan
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use Illuminate\Support\Facades\Log;

class SiswaController extends Controller
{
    // Menampilkan semua data siswa
    public function index(Request $request)
    {
        // Ambil parameter perPage dari query string, default 10 jika tidak ada
        $perPage = $request->input('perPage', 10);
        
        // Mengambil data siswa dengan pagination
        $siswa = Siswa::with('kelas')->paginate($perPage)->appends($request->only('perPage'));
    
        //return view('siswa.index', compact('siswa'));

        // Ambil parameter filter jika ada
        $search = $request->input('search');
        $status = $request->input('status');
        $kelasId = $request->input('id_kelas');

        // Mulai query untuk mengambil data siswa
        $query = Siswa::with('kelas');

        // Filter berdasarkan status jika diberikan
        if ($status) {
            $query->where('status', $status);
        }

        // Filter berdasarkan pencarian jika ada
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                ->orWhere('no_telepon', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan ID kelas jika diberikan
        if ($kelasId) {
            $query->where('id_kelas', $kelasId);
        }

        // Paginate hasil query
        // $siswa = $query->paginate(10);

        // Ambil semua kelas untuk dropdown filter
        $kelas = Kelas::all();

        return view('siswa.index', compact('siswa', 'kelas'));
    }

    // Menampilkan form untuk menambah siswa
    public function create()
    {
        $kelas = Kelas::all(); // Ambil semua data kelas
        return view('siswa.create', compact('kelas')); // Kirim data kelas ke view
    }

    // Menyimpan data siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'gender' => 'required|in:L,P', // Enum untuk jenis kelamin
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:Aktif,Keluar,Mutasi',
            'id_kelas' => 'required|exists:kelas,id',
        ]);

        Siswa::create($request->all()); // Simpan data siswa
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit siswa
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all(); // Ambil semua data kelas
        return view('siswa.edit', compact('siswa', 'kelas')); // Kirim data siswa dan kelas ke view
    }

    // Memperbarui data siswa
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'gender' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:Aktif,Keluar,Mutasi',
            'id_kelas' => 'required|exists:kelas,id',
        ]);

        $siswa->update($request->all()); // Update data siswa
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    // Menghapus siswa
    public function destroy(Siswa $siswa)
    {
        $siswa->delete(); // Hapus data siswa
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
    
    // Tambahkan di dalam class SiswaController
    public function export(Request $request)
    {
        Log::info('Export method called');
        $status = $request->input('status');
        $kelasId = $request->input('id_kelas');
        Log::info("Exporting with status: $status, kelas: $kelasId");

        return Excel::download(new SiswaExport($status, $kelasId), 'data_siswa.xlsx');
    }   
    
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa')); // Buat view siswa.show untuk menampilkan detail
    }

}