<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Profil $profil)
    {
        //
    }

    public function destroy(Profil $profil)
    {
        //
    }
}
