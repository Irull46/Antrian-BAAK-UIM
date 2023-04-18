@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Grid Kiri --}}
        <div class="col-md-9">
            {{-- Nomor Antrian --}}
            <div class="bg-success py-4 py-sm-5 mb-2">
                <h1 class="fw-bold text-center text-light">Nomor Antrian</h1>
                <div class="mx-5 bg-white border border-5">
                    <h1 class="fw-bold text-center m-0 py-3 py-sm-4 py-md-5">006</h1>
                </div>
            </div>
            
            {{-- Cart --}}
            <div class="">
                <div class="card mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 fw-bold">Performa pelayanan</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Grid Kanan --}}
        <div class="col-md-3">
            {{-- Head --}}
            <div class="bg-success pt-3 pb-1 px-2">
                <h4 class="fw-bold text-center text-light">Sisa Antrian</h4>
            </div>
            
            {{-- Body --}}
            <div class="bg-white px-3 py-3 d-flex justify-content-center">
                <h1 class="fw-bold text-center">34
                    <span class="fs-4 text-muted fst-italic">Orang</span>
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection
