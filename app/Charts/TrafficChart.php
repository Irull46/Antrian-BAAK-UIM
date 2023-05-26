<?php

namespace App\Charts;

use App\Models\Traffic;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TrafficChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $month = 5; // Bulan yang ingin Anda ambil datanya
        $year = Carbon::now()->year; // Tahun ini

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfWeek(); // Tanggal awal
        $endDate = Carbon::createFromDate($year, $month, 31)->endOfWeek(); // Tanggal akhir

        // Get jumlah antrian perminggu
        $weeklyCount = Traffic::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $weekCounts = $weeklyCount->groupBy(function ($item) {
            return $item->created_at->startOfWeek()->format('Y-m-d');
        })->map(function ($group) {
            return $group->count();
        });

        $weekCounts = $weekCounts->toArray(); // Object collection to Array asosiatif
        $weekCounts = array_values($weekCounts); // Array asosiatif to Array numeric

        // Get durasi antrian perminggu
        $weeklyData = Traffic::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") - INTERVAL DAYOFWEEK(created_at) - 1 DAY'))
            ->selectRaw('AVG(TIME_TO_SEC(durasi_pelayanan) / 60) as average')
            ->get();

        $weekAverages = [];

        foreach ($weeklyData as $week) {
            $average = $week->average ? floor($week->average) : 0;
            $weekAverages[] = $average;
        }

        return $this->chart->barChart()
            ->setTitle('Jumlah Antrian dan Durasi Pelayanan')
            ->addData('Jumlah Antrian', $weekCounts)
            ->addData('Durasi Pelayanan', $weekAverages)
            ->setXAxis(['Minggu ke-1', 'Minggu ke-2', 'Minggu ke-3', 'Minggu ke-4', 'Minggu ke-5'])
            ->setColors(['#198754', '#ffc107'])
            ->setFontFamily('Nunito Sans')
            ->setHeight(400)
            ->setGrid();
    }
}
