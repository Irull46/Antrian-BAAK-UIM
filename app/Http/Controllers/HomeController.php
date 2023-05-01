<?php

namespace App\Http\Controllers;

use App\Models\Antrian;

class HomeController extends Controller
{
    public function __invoke()
    {
        $antrian = Antrian::count();
        return view('home', compact('antrian'));
    }
}
