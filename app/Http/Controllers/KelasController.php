<?php

namespace App\Http\Controllers;

use App\Models\Kelas; 
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter perPage dari query string, default 10 jika tidak ada
        $perPage = $request->input('perPage', 10);
        
        // Mengambil data kelas dengan pagination
        $kelas = Kelas::paginate($perPage); // Ganti `all()` dengan `paginate()`

        return view('kelas.index', compact('kelas')); // Kirim data kelas ke view
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'jurusan' => 'nullable|string|max:50',
        ]);

        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit($id) {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }
    
    public function update(Request $request, $id) {
        $kelas = Kelas::findOrFail($id);
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'jurusan' => 'nullable|string|max:50',
        ]);
    
        $kelas->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }        

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        try {
            $kelas->delete();
            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Gagal menghapus kelas. Error: ' . $e->getMessage());
        }
    }
}
