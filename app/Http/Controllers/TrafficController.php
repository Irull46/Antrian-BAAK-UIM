<?php

namespace App\Http\Controllers;

use App\Charts\TrafficChart;
use App\Models\Traffic;
use Illuminate\Support\Facades\DB;

class TrafficController extends Controller
{
    public function index(TrafficChart $chart)
    {
        $average = Traffic::avg(DB::raw('TIME_TO_SEC(durasi_pelayanan)'));
        $detik = $average % 60;
        $menit = floor(($average / 60) % 60);
        $jam = floor($average / 3600);

        $average = '';
        if ($jam > 0) {
            $average .= $jam . ' jam ';
        }
        if ($menit > 0) {
            $average .= $menit . ' menit ';
        }
        if ($detik > 0) {
            $average .= $detik . ' detik';
        }

        return view('traffic', compact('average'), ['chart' => $chart->build()]);
    }
}
