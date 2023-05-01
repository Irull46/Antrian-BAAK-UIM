<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\CapabilityProfile;

class CetakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('cetak');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'jumlah_antrian' => 'required|numeric'
        ], [
            'jumlah_antrian.required' => 'Kolom input tidak boleh kosong.',
            'jumlah_antrian.numeric' => 'Kolom input hanya boleh angka.',
        ]);

        $jumlahAntrian = $request->input('jumlah_antrian');

        $sisa = Antrian::count();

        if($sisa == 0){
            for ($i = 1; $i <= $jumlahAntrian; $i++) {
                $antrian = Antrian::create([
                    'nomor_antrian' => $i,
                ]);
                $antrian->save();
            }
        } else if ($sisa > 0) {
            $sisa += 1;
            $jumlahAntrians = $jumlahAntrian + $sisa;

            for ($i = $sisa; $i <= $jumlahAntrians; $i++) {
                $antrian = Antrian::create([
                    'nomor_antrian' => $i,
                ]);
                $antrian->save();
            }
            return redirect()->back()->with('success', 'Nomor antrian berhasil dibuat.');
        }
    }
}
