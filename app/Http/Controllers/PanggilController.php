<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
