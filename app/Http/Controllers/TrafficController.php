<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrafficController extends Controller
{
    public function index()
    {
        return view('traffic');
    }
}
