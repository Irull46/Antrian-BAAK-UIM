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
}
