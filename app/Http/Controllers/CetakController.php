<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Panggilan;
use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;

class CetakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Antrian::all();
        return view('cetak', compact('data'));
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'jumlah_antrian' => 'required|numeric',
            'bagian' => 'in:A,B,AB'
        ], [
            'jumlah_antrian.required' => 'Kolom :attribute tidak boleh kosong.',
            'jumlah_antrian.numeric' => 'Kolom :attribute hanya boleh angka.',
            'bagian.in' => 'Pilih BAAK, BAUK atau SEMUA.',
        ]);

        $jumlah_antrian = $request->jumlah_antrian;
        $bagian = $request->bagian;

        $total = Antrian::count();
        
        if ($total == null) {
            if ($bagian === 'A' || $bagian === 'B') {
                for ($i = 1; $i <= $jumlah_antrian; $i++) {
                    $antrian = Antrian::create([
                        'nomor_antrian' => $bagian . $i,
                    ]);
                }
            } else {
                for ($i = 1; $i <= $jumlah_antrian; $i++) {
                    $antrian = Antrian::create([
                        'nomor_antrian' => 'A' . $i,
                    ]);
                    $antrian = Antrian::create([
                        'nomor_antrian' => 'B' . $i,
                    ]);
                }
            }
        } else {
            if ($bagian === 'A' || $bagian === 'B') {
                if ($bagian === 'A') {
                    $antrianTerakhir = Antrian::orderByRaw('CAST(SUBSTRING_INDEX(nomor_antrian, "A", -1) AS UNSIGNED) DESC')->first();
                } else {
                    $antrianTerakhir = Antrian::orderByRaw('CAST(SUBSTRING_INDEX(nomor_antrian, "B", -1) AS UNSIGNED) DESC')->first();
                }

                $antrianTerakhir = substr($antrianTerakhir->nomor_antrian, 1);

                $jumlah_antrian = $jumlah_antrian + $antrianTerakhir;

                for ($i = $antrianTerakhir + 1; $i <= $jumlah_antrian; $i++) {
                    Antrian::create([
                        'nomor_antrian' => $bagian . $i,
                    ]);
                }
            } else {
                $antrianTerakhirA = Antrian::orderByRaw('CAST(SUBSTRING_INDEX(nomor_antrian, "A", -1) AS UNSIGNED) DESC')->first();
                $antrianTerakhirB = Antrian::orderByRaw('CAST(SUBSTRING_INDEX(nomor_antrian, "B", -1) AS UNSIGNED) DESC')->first();

                $antrianTerakhirA = substr($antrianTerakhirA->nomor_antrian, 1);
                $antrianTerakhirB = substr($antrianTerakhirB->nomor_antrian, 1);

                $jumlah_antrianA = $jumlah_antrian + $antrianTerakhirA;
                $jumlah_antrianB = $jumlah_antrian + $antrianTerakhirB;

                for ($i = $antrianTerakhirA + 1; $i <= $jumlah_antrianA; $i++) {
                    Antrian::create([
                        'nomor_antrian' => 'A' . $i,
                    ]);
                }
                for ($i = $antrianTerakhirB + 1; $i <= $jumlah_antrianB; $i++) {
                    Antrian::create([
                        'nomor_antrian' => 'B' . $i,
                    ]);
                }
            }
        }
        
        return redirect()->back()->with('message', 'Nomor antrian berhasil disimpan!');
    }

    public function clear()
    {
        Antrian::query()->delete();
        Panggilan::query()->delete();

        return redirect()->route('cetak.index')->with('message', 'Data antrian berhasil dihapus!');
    }
}
