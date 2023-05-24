<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profil;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('profil');
    }

    public function ajax(Request $request)
    {
        $profil = Profil::where('user_id', $request->id)->first();

        return response()->json([
            'tanggal_lahir' => isset($profil->tanggal_lahir) ? Carbon::createFromFormat('Y-m-d', $profil->tanggal_lahir)->format('d-m-Y') : 'zonk',
            'alamat' => isset($profil->alamat) ? $profil->alamat : 'zonk',
            'jenis_kelamin' => isset($profil->jenis_kelamin) ? $profil->jenis_kelamin : 'zonk',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|max:255',
            'jenis_kelamin' => 'required',
        ], [
            'name.required' => 'Kolom :attribute tidak boleh kosong.',
            'tanggal_lahir.required' => 'Kolom :attribute tidak boleh kosong.',
            'alamat.required' => 'Kolom :attribute tidak boleh kosong.',
            'jenis_kelamin.required' => 'Kolom :attribute tidak boleh kosong.',
        ]);

        $profil = Profil::where('user_id', $request->id)->first();
        
        if($profil == null) {
            Profil::create([
                'user_id' => $request->id,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);
            return redirect()->back()->with('success', 'Profil berhasil dibuat!');
        } else {
            $profil->tanggal_lahir = $request->tanggal_lahir;
            $profil->alamat = $request->alamat;
            $profil->jenis_kelamin = $request->jenis_kelamin;
            $profil->save();
        }
        
        return redirect()->back()->with('success', 'Profil Berhasi diperbarui!');
    }
}
