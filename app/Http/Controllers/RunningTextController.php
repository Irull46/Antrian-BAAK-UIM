<?php

namespace App\Http\Controllers;

use App\Models\RunningText;
use Illuminate\Http\Request;

class RunningTextController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $runningTexts = RunningText::orderBy('order', 'asc')->get();

        return view('home', compact('runningTexts'));
    }
}
