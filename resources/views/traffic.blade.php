@extends('layouts.app')

@section('content')
<div class="h-100 pt-80-sip">
    <div class="container py-3">
        <div class="fs-2 fw-bold">Traffic</div>
        <div class="fs-5 mb-4">Memperlihatkan performa pelayanan.</div>
        
        <div class="row p-2">
            <div class="col-md-3 border-end mb-3 mb-md-0">
                <h5 class="fw-bold">Nilai rata-rata</h5>
                <div class="d-flex flex-row align-items-center">
                    <div class="bg-success rounded-pill me-2" style="width: 25px; height: 5px;"></div>
                    <h6 class="fw-bold m-0">Durasi Pelayanan Keseluruhan</h6>
                </div>
                <p class="text-muted" style="margin-left: 33px;">{{ $average }}</p>
            </div>
            <div class="col-md-9">
                <div class="m-0 p-0">
                    {!! $chart->container() !!}
                </div>

                <script src="{{ $chart->cdn() }}"></script>

                {{ $chart->script() }}
            </div>
        </div>
    </div>
</div>
@endsection