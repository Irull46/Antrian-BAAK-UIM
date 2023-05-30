<?php

namespace App\Http\Controllers;

use App\Events\CallExecute;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function call(Request $request)
    {
        $bagian = $request->bagian;
        $nomor = $request->nomor;
        $posisi = $request->posisi;

        event(new CallExecute([$bagian, $nomor, $posisi]));

        return response()->json([
            'bagian' => $request->bagian,
            'nomor' => $request->nomor,
            'posisi' => $request->posisi,
        ]);
    }
}
