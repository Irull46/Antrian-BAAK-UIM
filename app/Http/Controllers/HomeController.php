<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Panggilan;
use App\Models\PosisiTeller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function ajax()
    {
        // Get data antrian berdasarkan status proses yang terakhir diupdate
        $antrian = Antrian::where('status', 'proses')
            ->latest('updated_at')
            ->first();

        // Get jumlah antrian yang statusnya menunggu atau terlambat
        $sisaA = Antrian::where('nomor_antrian', 'LIKE', 'A%')
            ->whereIn('status', ['menunggu', 'terlambat'])
            ->count();
        $sisaB = Antrian::where('nomor_antrian', 'LIKE', 'B%')
            ->whereIn('status', ['menunggu', 'terlambat'])
            ->count();

        // Get data panggilan dengan posisi teller
        $panggilan = Panggilan::with('posisiTeller')
            ->latest('created_at')
            ->first();

        // Get semua data posisi teller dengan relasinya (tabel user, tabel panggilan dengan tabel antrian yang diupdate terakhir)
        $data = PosisiTeller::with(['user', 'panggilan' => function ($query) {
            $query->with(['antrian' => function ($query) {
                $query->orderBy('id', 'desc');
            }])->latest('updated_at');
        }])->orderBy('posisi', 'asc')->get();

        return response()->json([
            'nomor_antrian' => $antrian ? $antrian->nomor_antrian : 'zonk',
            'posisi' => $panggilan ? $panggilan->posisiTeller->posisi : 'zonk',
            'sisaA' => $sisaA ? $sisaA : 'zonk',
            'sisaB' => $sisaB ? $sisaB : 'zonk',

            'nomor_antrian1' => isset($data[0]->panggilan[0]->antrian->nomor_antrian) ? $data[0]->panggilan[0]->antrian->nomor_antrian : 'zonk',
            'nomor_antrian2' => isset($data[1]->panggilan[0]->antrian->nomor_antrian) ? $data[1]->panggilan[0]->antrian->nomor_antrian : 'zonk',
            'nomor_antrian3' => isset($data[2]->panggilan[0]->antrian->nomor_antrian) ? $data[2]->panggilan[0]->antrian->nomor_antrian : 'zonk',
            'nomor_antrian4' => isset($data[3]->panggilan[0]->antrian->nomor_antrian) ? $data[3]->panggilan[0]->antrian->nomor_antrian : 'zonk',
            'nomor_antrian5' => isset($data[4]->panggilan[0]->antrian->nomor_antrian) ? $data[4]->panggilan[0]->antrian->nomor_antrian : 'zonk',
            
            'nama1' => isset($data[0]->user->name) ? $data[0]->user->name : 'zonk',
            'nama2' => isset($data[1]->user->name) ? $data[1]->user->name : 'zonk',
            'nama3' => isset($data[2]->user->name) ? $data[2]->user->name : 'zonk',
            'nama4' => isset($data[3]->user->name) ? $data[3]->user->name : 'zonk',
            'nama5' => isset($data[4]->user->name) ? $data[4]->user->name : 'zonk',
        ]);
    }
}
