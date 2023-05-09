<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\PenggunaAntrian;
use App\Models\Traffic;
use App\Models\User;
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
        $teller = $_POST['id'];

        $antrian = Antrian::where('status', 'menunggu')->first();
        $antrianTerlambat = Antrian::where('status', 'terlambat')->first();

        if ($antrian !== null) {
            // Mengubah status menunggu menjadi proses
            $antrian->status = 'proses';
            $antrian->save();
            
            // Mulai pelayanan
            $traffic = new Traffic();
            $traffic->antrian_id = $antrian->id;
            $traffic->mulai_pelayanan = now();
            $traffic->save();
            
            // Menyimpaan data teller dan nomor antrian yang dilayani
            $penggunaAntrian = new PenggunaAntrian();
            $penggunaAntrian->user_id = $teller;
            $penggunaAntrian->antrian_id = $antrian->id;
            $penggunaAntrian->save();
        } else if ($antrian === null && $antrianTerlambat !== null) {
            // Mengubah status terlambat menjadi proses
            $antrianTerlambat->status = 'proses';
            $antrianTerlambat->save();
            
            // Update mulai pelayanan
            $traffic = Traffic::find($antrianTerlambat->id);
            $traffic->mulai_pelayanan = now();
            $traffic->update();
            
            // Menyimpaan data teller dan nomor antrian yang dilayani
            $penggunaAntrian = new PenggunaAntrian();
            $penggunaAntrian->user_id = $teller;
            $penggunaAntrian->antrian_id = $antrianTerlambat->id;
            $penggunaAntrian->save();
        } else {
            return response()->json(['message' => 'Tidak ada antrian yang tersedia'], 404);
        }
    }

    public function selesai()
    {
        $antrian = $_POST['antrian'];
        $nomorAntrian = Antrian::where('nomor_antrian', $antrian)->first();
        $nomorAntrian->status = 'selesai';
        $nomorAntrian->save();

        $traffic = Traffic::find($antrian);
        $traffic->selesai_pelayanan = now();
        // $traffic->durasi_pelayanan = $traffic->mulai_pelayanan->diffInMinutes($traffic->selesai_pelayanan);
        $traffic->update();
        
        return response()->json(['antrian' => $antrian]);
    }
}
