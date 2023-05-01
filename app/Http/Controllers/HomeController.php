<?php

namespace App\Http\Controllers;

use App\Models\Antrian;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function ajax()
    {
        $sisa = Antrian::count();
        
        $antrian = Antrian::where('status', 'proses')
        ->latest('updated_at')
        ->first();

        $sisa = $sisa - ($antrian ? $antrian->nomor_antrian : 0);

        $nomor_antrian = $antrian ? $antrian->nomor_antrian : '-';

        return response()->json([
            'sisa' => $sisa,
            'nomor_antrian' => $nomor_antrian,
        ]);
    }
}
