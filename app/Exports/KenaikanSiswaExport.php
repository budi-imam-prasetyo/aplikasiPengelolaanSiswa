<?php

namespace App\Exports;

use App\Models\Kenaikan;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KenaikanSiswaExport implements FromView, ShouldAutoSize
{
    protected $tahunAjaran;
    protected $kelasAsal;
    protected $kelasTujuan;

    public function __construct($tahunAjaran = null, $kelasAsal = null, $kelasTujuan = null)
    {
        $this->tahunAjaran = $tahunAjaran;
        $this->kelasAsal = $kelasAsal;
        $this->kelasTujuan = $kelasTujuan;
    }

    public function view(): View
    {
        try {
            Log::info('KenaikanExport view method called');
            Log::info("Tahun Ajaran: {$this->tahunAjaran}, Kelas Asal: {$this->kelasAsal}, Kelas Tujuan: {$this->kelasTujuan}");

            $query = Kenaikan::with('siswa');

            if ($this->tahunAjaran) {
                $query->where('tahun_ajaran', $this->tahunAjaran);
                Log::info("Filtering by Tahun Ajaran: {$this->tahunAjaran}");
            }

            if ($this->kelasAsal) {
                $query->where('kelas_asal', $this->kelasAsal);
                Log::info("Filtering by Kelas Asal: {$this->kelasAsal}");
            }

            if ($this->kelasTujuan) {
                $query->where('kelas_tujuan', $this->kelasTujuan);
                Log::info("Filtering by Kelas Tujuan: {$this->kelasTujuan}");
            }

            $kenaikan = $query->get();
            Log::info("Total kenaikan retrieved: " . $kenaikan->count());

            return view('exports.kenaikan', [
                'kenaikan' => $kenaikan
            ]);
        } catch (\Exception $e) {
            Log::error('Error in KenaikanExport: ' . $e->getMessage());
            throw $e;
        }
    }
}
