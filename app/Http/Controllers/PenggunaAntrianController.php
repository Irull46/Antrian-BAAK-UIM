<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\PenggunaAntrian;
use Illuminate\Http\Request;

class PenggunaAntrianController extends Controller
{
    public function panggil(Request $request){
        // $teller = User::findOrFail($request->user_id);
        $teller = 2;

        $antrian = Antrian::where('status', 'menunggu')->first();

        if ($antrian) {
            $antrian->status = 'proses';
            $antrian->save();
            
            $penggunaAntrian = new PenggunaAntrian();
            $penggunaAntrian->user_id = $teller;
            $penggunaAntrian->antrian_id = $antrian->id;
            $penggunaAntrian->save();
            
            // return response()->json(['message' => 'Antrian berhasil dipanggil'], 200);
        } else {
            return response()->json(['message' => 'Tidak ada antrian yang tersedia'], 404);
        }
    }
}
