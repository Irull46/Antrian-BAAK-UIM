<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profil;
use Illuminate\Http\Request;

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

        $tanggal_lahir = $profil ? $profil->tanggal_lahir : null;
        $alamat = $profil ? $profil->alamat : null;
        $jenis_kelamin = $profil ? $profil->jenis_kelamin : null;

        return response()->json([
            'tanggal_lahir' => $tanggal_lahir,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|alpha|max:255',
            'jenis_kelamin' => 'required',
        ], [
            'name.required' => 'Kolom :attribute tidak boleh kosong.',
            'tanggal_lahir.required' => 'Kolom :attribute tidak boleh kosong.',
            'alamat.required' => 'Kolom :attribute tidak boleh kosong.',
            'alamat.alpha' => 'Kolom :attribute hanya boleh huruf.',
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
            $profil->user_id = $request->id;
            $profil->tanggal_lahir = $request->tanggal_lahir;
            $profil->alamat = $request->alamat;
            $profil->jenis_kelamin = $request->jenis_kelamin;
            $profil->save();
        }
        
        return redirect()->back()->with('success', 'Profil Berhasi diperbarui!');
    }
}
