<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

    public function ajax()
    {
        $userId = Auth::id();
        $profil = Profil::where('user_id', $userId)->first();

        return response()->json([
            'foto' => isset($profil->foto) ? $profil->foto : 'Belum diisi',
            'tanggal_lahir' => isset($profil->tanggal_lahir) ? $profil->tanggal_lahir : 'Belum diisi',
            'alamat' => isset($profil->alamat) ? $profil->alamat : 'Belum diisi',
            'jenis_kelamin' => isset($profil->jenis_kelamin) ? $profil->jenis_kelamin : 'Belum diisi',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|max:255',
            'jenis_kelamin' => 'required',
        ], [
            'name.required' => 'Kolom :attribute tidak boleh kosong.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'tanggal_lahir.required' => 'Kolom :attribute tidak boleh kosong.',
            'alamat.required' => 'Kolom :attribute tidak boleh kosong.',
            'jenis_kelamin.required' => 'Kolom :attribute tidak boleh kosong.',
        ]);

        $profil = Profil::where('user_id', $request->id)->first();
        
        if($profil == null) {
            $data = Profil::create([
                'user_id' => $request->id,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            if ($request->hasFile('foto')) {
                $request->file('foto')->move('userphoto', $request->file('foto')->getClientOriginalname());
                $data->foto = $request->file('foto')->getClientOriginalname();
                $data->save();
            }

            return redirect()->back()->with('success', 'Profil berhasil dibuat!');
        } else {
            $profil->tanggal_lahir = $request->tanggal_lahir;
            $profil->alamat = $request->alamat;
            $profil->jenis_kelamin = $request->jenis_kelamin;
            if ($request->hasFile('foto')) {
                $request->file('foto')->move('userphoto', $request->file('foto')->getClientOriginalname());
                $profil->foto = $request->file('foto')->getClientOriginalname();
            }
            $profil->save();
            
            return redirect()->back()->with('success', 'Profil Berhasi diperbarui!');
        }
    }
}
