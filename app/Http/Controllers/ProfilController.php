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

    public function update(Request $request, User $user, Profil $profil)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
        ], [
            'name.required' => 'Kolom input tidak boleh kosong.',
            'tanggal_lahir.required' => 'Kolom input tidak boleh kosong.',
            'alamat.required' => 'Kolom input tidak boleh kosong.',
            'jenis_kelamin.required' => 'Kolom input tidak boleh kosong.',
        ]);
        
        $profil->user_id = $request->id;
        $profil->tanggal_lahir = $request->tanggal_lahir;
        $profil->alamat = $request->alamat;
        $profil->jenis_kelamin = $request->jenis_kelamin;
        $profil->save();

        return redirect()->back()->with('success', 'Profil Berhasi diperbarui!');
    }
}
