<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Panggilan;
use App\Models\PosisiTeller;
use App\Models\Traffic;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function ajax(Request $request)
    {
        // Get id yang dikirim dari request ajax
        $user_id = $request->input('id');

        // Get posisi_tellers berdasarkan user_id
        $posisi_teller = PosisiTeller::where('user_id', $user_id)->first();

        // Get terakhir diupdate pada tabel panggilans berdasarkan user_id
        $panggilan = Panggilan::where('user_id', $user_id)
            ->whereNotNull('antrian_id')
            ->latest('updated_at')
            ->first();

        // Get jumlah pada tabel antrians yang awalan huruf A yang statusnya menunggu atau terlambat
        $sisaA = Antrian::where('nomor_antrian', 'LIKE', 'A%')
            ->whereIn('status', ['menunggu', 'terlambat'])
            ->count();
        $sisaB = Antrian::where('nomor_antrian', 'LIKE', 'B%')
            ->whereIn('status', ['menunggu', 'terlambat'])
            ->count();

        // Mengembalikan response dalam bentuk json
        return response()->json([
            'nomor_antrian' => $panggilan ? $panggilan->antrian->nomor_antrian : 'zonk',
            'bagian' => $posisi_teller ? $posisi_teller->bagian : 'zonk',
            'posisi' => $posisi_teller ? $posisi_teller->posisi : 'zonk',
            'sisaA' => $sisaA ? $sisaA : 'zonk',
            'sisaB' => $sisaB ? $sisaB : 'zonk',
        ]);
    }

    public function lanjut(Request $request)
    {
        $user_id = $request->input('id');
        $nomor_antrian = $request->input('nomor_antrian');

        if ($nomor_antrian !== 'zonk') {
            // Get antrian berdasarkan nomor antrian yang statusnya proses
            $antrian = Antrian::where('nomor_antrian', $nomor_antrian)
                ->whereIn('status', ['proses', 'terlambat'])
                ->first();
            
            // Jika status antriannya proses maka ubah ke terlambat
            if ($antrian->status === 'proses') {
                $antrian->status = 'terlambat';
                $antrian->save();
                
                // return response()->json(['message' => 'Antrian ' . $antrian->nomor_antrian . ' terlambat']);
            }
        }

        // Get posisi teller berdasarkan user_id
        $posisi_teller = PosisiTeller::where('user_id', $user_id)->first();

        // Jika posisi teller A
        if ($posisi_teller->bagian === 'A') {
            // Get antrian A yang statusnya menunggu
            $antrianMenunggu = Antrian::where('nomor_antrian', 'LIKE', 'A%')
                ->where('status', 'menunggu')
                ->whereRaw("nomor_antrian REGEXP '^A([1-9]|[1-9][0-9]{1,2}|[1-9][0-8][0-9]|999)$'")
                ->orderByRaw("CAST(SUBSTRING(nomor_antrian, 2) AS UNSIGNED)")
                ->first();

            $antrianTerlambat = Antrian::where('nomor_antrian', 'LIKE', 'A%')
                ->where('status', 'terlambat')
                ->orderBy('updated_at', 'asc')
                ->first();
        } else {
            // Get antrian B yang statusnya menunggu
            $antrianMenunggu = Antrian::where('nomor_antrian', 'LIKE', 'B%')
                ->where('status', 'menunggu')
                ->whereRaw("nomor_antrian REGEXP '^B([1-9]|[1-9][0-9]{1,2}|[1-9][0-8][0-9]|999)$'")
                ->orderByRaw("CAST(SUBSTRING(nomor_antrian, 2) AS UNSIGNED)")
                ->first();
                
            $antrianTerlambat = Antrian::where('nomor_antrian', 'LIKE', 'B%')
                ->where('status', 'terlambat')
                ->orderBy('updated_at', 'asc')
                ->first();
        }

        if ($antrianMenunggu !== null) {
            // Update status menunggu menjadi proses
            $antrianMenunggu->status = 'proses';
            $antrianMenunggu->save();
            
            // Simpan posisi teller id, user id, dan nomor antrian id
            $panggilan = new Panggilan();
            $panggilan->posisi_teller_id = $posisi_teller->id;
            $panggilan->user_id = $user_id;
            $panggilan->antrian_id = $antrianMenunggu->id;
            $panggilan->save();
            
            // Simpan antrian id dan waktu mulai pelayanan
            $traffic = new Traffic();
            $traffic->antrian_id = $antrianMenunggu->id;
            $traffic->mulai_pelayanan = now();
            $traffic->save();

            return response()->json(['message' => 'Antrian menunggu (' . $antrianMenunggu->nomor_antrian . ') sedang diproses']);
        } else if ($antrianTerlambat !== null) {
            // Update status terlambat menjadi proses
            $antrianTerlambat->status = 'proses';
            $antrianTerlambat->save();
            
            // Update posisi teller id, user id, dan updated_at
            $panggilan = Panggilan::where('antrian_id', $antrianTerlambat->id)->first();
            $panggilan->posisi_teller_id = $posisi_teller->id;
            $panggilan->user_id = $user_id;
            $panggilan->save();
            $panggilan->touch(); // Memperbarui nilai updated_at meskipun tidak ada perubahan data. Menggunakan ini karena nomor antrian yang akan ditampilkan di halaman panggil antrian adalah nomor antrian dari tabel panggilan berdasarkan id teller yang login dan berdasarkan updated_at terakhir.
            
            // Update mulai pelayanan dan updated_at
            $traffic = Traffic::where('antrian_id', $antrianTerlambat->id)->first();
            $traffic->mulai_pelayanan = now();
            $traffic->save();

            return response()->json(['message' => 'Antrian terlambat (' . $antrianTerlambat->nomor_antrian . ') sedang diproses']);
        } else {
            return response()->json(['message' => 'Tidak ada antrian yang tersedia']);
        }
    }

    public function selesai(Request $request)
    {
        $nomor_antrian = $request->input('nomor_antrian');

        $nomorAntrian = Antrian::where('nomor_antrian', $nomor_antrian)->first();
        $nomorAntrian->status = 'selesai';
        $nomorAntrian->save();

        $traffic = Traffic::where('antrian_id', $nomorAntrian->id)->first();
        $traffic->selesai_pelayanan = now();

        $mulai = $traffic->mulai_pelayanan;
        $selesai = Carbon::now();
        
        $carbon1 = Carbon::parse($mulai);
        $carbon2 = Carbon::parse($selesai);
        
        $diff = $carbon1->diff($carbon2);
        $traffic->durasi_pelayanan = $diff->format('%H:%I:%S');

        $traffic->save();
        $nomorAntrian->delete();
        
        return response()->json(['nomor_antrian' => 'Antrian ' . $nomor_antrian . ' selesai']);
    }
}
