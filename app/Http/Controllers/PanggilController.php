<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\PenggunaAntrian;
use Illuminate\Http\Request;

class PanggilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('panggil');
    }

    public function ajax()
    {
        $sisa = Antrian::where(function($query) {
            $query->where('status', 'menunggu')
                ->orWhere('status', 'terlambat');
        })->count();
        
        $antrian = Antrian::where('status', 'proses')
        ->latest('updated_at')
        ->first();

        $nomor_antrian = $antrian ? $antrian->nomor_antrian : '-';

        return response()->json([
            'sisa' => $sisa,
            'nomor_antrian' => $nomor_antrian,
        ]);
    }

    public function lanjut(Request $request){
        // $teller = User::findOrFail($request->user_id);
        $teller = 2;

        $antrian = Antrian::where('status', 'menunggu')->first();
        $antrianTerlambat = Antrian::where('status', 'terlambat')->first();

        if ($antrian !== null) {
            $antrian->status = 'proses';
            $antrian->save();
            
            $penggunaAntrian = new PenggunaAntrian();
            $penggunaAntrian->user_id = $teller;
            $penggunaAntrian->antrian_id = $antrian->id;
            $penggunaAntrian->save();
        } else if ($antrian === null && $antrianTerlambat !== null) {
            $antrianTerlambat->status = 'proses';
            $antrianTerlambat->save();
            
            $penggunaAntrian = new PenggunaAntrian();
            $penggunaAntrian->user_id = $teller;
            $penggunaAntrian->antrian_id = $antrianTerlambat->id;
            $penggunaAntrian->save();
        } else {
            return response()->json(['message' => 'Tidak ada antrian yang tersedia'], 404);
        }
    }

    public function panggil(Request $request, $id)
    {
        //
    }

    public function selesai()
    {
        $antrian = $_POST['antrian'];
        $nomorAntrian = Antrian::where('nomor_antrian', $antrian)->first();
        $nomorAntrian->status = 'selesai';
        $nomorAntrian->save();
        
        return response()->json(['antrian' => $antrian]);
    }

    public function destroy($id)
    {
        //
    }
}
