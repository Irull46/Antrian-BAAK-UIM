<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Panggilan;
use App\Models\PosisiTeller;
use App\Models\Traffic;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $user_id = Auth::id();

        $posisi_teller = PosisiTeller::where('user_id', $user_id)->first();

        $panggilan = Panggilan::where('user_id', $user_id)
            ->whereNotNull('antrian_id')
            ->latest('updated_at')
            ->first();

        $sisaA = Antrian::where('nomor_antrian', 'LIKE', 'A%')
            ->whereIn('status', ['menunggu', 'terlambat'])
            ->count();
        $sisaB = Antrian::where('nomor_antrian', 'LIKE', 'B%')
            ->whereIn('status', ['menunggu', 'terlambat'])
            ->count();

        return response()->json([
            'nomor_antrian' => $panggilan && $panggilan->antrian->status == 'proses' ? $panggilan->antrian->nomor_antrian : '-',
            'bagian' => $posisi_teller ? $posisi_teller->bagian : '-',
            'posisi' => $posisi_teller ? $posisi_teller->posisi : '-',
            'sisaA' => $sisaA ? $sisaA : '-',
            'sisaB' => $sisaB ? $sisaB : '-',
        ]);
    }

    public function kembali()
    {
        $user_id = Auth::id();

        $antrianTerlambat = Panggilan::with('antrian')
            ->where('user_id', $user_id)
            ->whereHas('antrian', function ($query) {
                $query->where('status', 'terlambat');
            })
            ->orderBy('updated_at', 'desc')
            ->first();

        if ($antrianTerlambat) {
            $panggilan = Panggilan::with('antrian')
                ->where('user_id', $user_id)
                ->orderBy('updated_at', 'desc')
                ->first();

            $antrian_id = $panggilan->antrian->id;

            $panggilan->delete();

            $antrian = Antrian::where('id', $antrian_id)->first();
            $antrian->status = 'menunggu';
            $antrian->updated_at = $antrian->created_at;
            $antrian->save();

            $antrian = Antrian::where('id', $antrianTerlambat->antrian_id)->first();
            $antrian->status = 'proses';
            $antrian->updated_at = now();
            $antrian->save();
            
            $traffic = Traffic::where('antrian_id', $antrian_id)->first();
            $traffic->delete();

            $traffic = Traffic::where('antrian_id', $antrianTerlambat->antrian_id)->first();
            $traffic->antrian_id = $antrian->id;
            $traffic->mulai_pelayanan = now();
            $traffic->save();
        } else {
            return response()->json([ 'message' => 'Tidak ada antrian dengan status terlambat.' ]);
        }
    }

    public function lanjut(Request $request)
    {
        $user_id = $request->input('id');
        $nomor_antrian = $request->input('nomor_antrian');

        if ($nomor_antrian !== '-') {
            $antrian = Antrian::where('nomor_antrian', $nomor_antrian)
                ->whereIn('status', ['proses', 'terlambat'])
                ->first();
            
            if ($antrian->status === 'proses') {
                $antrian->status = 'terlambat';
                $antrian->save();
            }
        }

        $posisi_teller = PosisiTeller::where('user_id', $user_id)->first();

        if ($posisi_teller->bagian === 'A') {
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
            $antrianMenunggu->status = 'proses';
            $antrianMenunggu->save();
            
            $panggilan = new Panggilan();
            $panggilan->posisi_teller_id = $posisi_teller->id;
            $panggilan->user_id = $user_id;
            $panggilan->antrian_id = $antrianMenunggu->id;
            $panggilan->save();
            
            $traffic = new Traffic();
            $traffic->antrian_id = $antrianMenunggu->id;
            $traffic->mulai_pelayanan = now();
            $traffic->save();
        } else if ($antrianTerlambat !== null) {
            $antrianTerlambat->status = 'proses';
            $antrianTerlambat->save();
            
            $panggilan = Panggilan::where('antrian_id', $antrianTerlambat->id)->first();
            $panggilan->posisi_teller_id = $posisi_teller->id;
            $panggilan->user_id = $user_id;
            $panggilan->save();
            $panggilan->touch();
            
            $traffic = Traffic::where('antrian_id', $antrianTerlambat->id)->first();
            $traffic->mulai_pelayanan = now();
            $traffic->save();
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
    }
}
