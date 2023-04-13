@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Grid Kiri --}}
        <div class="col-md-10">
            <div class="bg-success py-3 mb-3">
                <h1 class="fw-bold text-center text-light">Nomor Antrian</h1>
                <div class="mx-5 bg-white border border-5">
                    <h1 class="fw-bold text-center py-5">006</h1>
                </div>
            </div>
        </div>
    
        {{-- Grid Kanan --}}
        <div class="col-md-2">
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

            <div class="mt-3 h-75 d-flex flex-column justify-content-evenly">
                <button type="button" class="btn btn-outline-success btn-lg">LANJUT</button>
                <button type="button" class="btn btn-outline-success btn-lg">PANGGIL</button>
                <button type="button" class="btn btn-outline-success btn-lg">SELESAI</button>
                <button type="button" class="btn btn-outline-success btn-lg">KELUAR</button>
            </div>
        </div>
    </div>
</div>
@endsection
