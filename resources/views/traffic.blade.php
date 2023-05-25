@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2">
        <div class="fs-3 fw-bold">Traffic</div>
        <div class="fs-5 mb-4">Memperlihatkan performa pelayanan BAAk UIM.</div>
        
        <div class="row">
            <div class="col-md-2 border-end">
                <h5 class="fw-bold">Nilai rata-rata</h5>
                <div class="d-flex flex-row align-items-center">
                    <div class="bg-success rounded-pill me-2" style="width: 25px; height: 5px;"></div>
                    <h6 class="fw-bold m-0">Durasi Pelayanan</h6>
                </div>
                <p class="text-muted"><span class="time" style="margin-left: 33px;">10</span> menit</p>
            </div>
            <div class="col-md-10">
                <p>Ini traffic</p>
            </div>
        </div>
    </div>
@endsection