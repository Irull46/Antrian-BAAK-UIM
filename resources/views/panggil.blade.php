@extends('layouts.app')

@section('content')
<div class="container-fluid" id="text-to-speech">
    <div class="row">
        {{-- Grid Kiri --}}
        <div class="col-md-9 col-lg-10">
            {{-- Nomor Antrian --}}
            <div class="bg-success py-4 py-sm-5 mb-2">
                <h1 class="fw-bold text-center text-light">Nomor Antrian</h1>
                <div class="mx-5 bg-white border border-5">
                    <h1 class="fw-bold text-center m-0 py-3 py-sm-4 py-md-5" id="antrian"></h1>
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
        <div class="col-md-3 col-lg-2">
            {{-- Head --}}
            <div class="bg-success pt-3 pb-1 px-2">
                <h4 class="fw-bold text-center text-light">Sisa Antrian</h4>
            </div>
            
            {{-- Body --}}
            <div class="bg-white px-3 py-3 d-flex justify-content-center">
                <h1 class="fw-bold text-center" id="sisa"></h1>
            </div>

            <div class="mt-2 d-flex flex-column">
                <button id="btnLanjut" class="btn btn-outline-success btn-lg mb-2">LANJUT</button>
                <button id="speak" class="btn btn-outline-success btn-lg mb-2">PANGGIL</button>
                <button id="btnSelesai" class="btn btn-outline-success btn-lg mb-2">SELESAI</button>
                <a href="{{ route('home.index') }}" class="btn btn-outline-success btn-lg mb-2">KELUAR</a>
            </div>
        </div>
    </div>

    <div style="display: none">
        <select id="voices"></select>
        <select id="speed">
            <option value="0.5">0.5x</option>
            <option value="1.0" selected>1.0x</option>
            <option value="1.5">1.5x</option>
            <option value="2.0">2.0x</option>
            <option value="4.0">4.0x</option>
            <option value="10.0">10.0x</option>
        </select>
        <select id="pitch">
            <option value="0.0">Pitch - 0</option>
            <option value="0.5">Pitch - 0.5</option>
            <option value="1.0" selected>Pitch - 1</option>
            <option value="1.5">Pitch - 1.5</option>
            <option value="2.0">Pitch - 2</option>
        </select>
        <button id="pause">Pause</button>
        <button id="cancel">Cancel</button>
    </div>
</div>

<script src="{{ asset('js/text-to-speech.js') }}"></script>

<script>
    $(document).ready(function() {
        setInterval(function() {
            $.ajax({
                url: "{{ route('panggil.ajax') }}",
                type: 'GET',
                success: function(response) {
                    $('#antrian').text(response.nomor_antrian);
                    $('#sisa').text(response.sisa);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText)
                }
            });
        }, 1000);

        $('#btnLanjut').click(function() {
            $.ajax({
                url: "{{ route('panggil.lanjut') }}",
                type: 'GET',
                success: function(response) {
                    console.log('Berhasil!')
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText)
                }
            });
        });

        $('#btnSelesai').click(function() {
            let antrian = $("#antrian").text();
            $.ajax({
                url: "{{ route('panggil.selesai') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    antrian: antrian
                },
                success: function(response) {
                    console.log('Berhasil!')
                    console.log(response.antrian)
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText)
                }
            });
        });
    });
</script>

{{-- Page level plugins --}}
<script src="{{ asset('js/Chart.min.js') }}"></script>

{{-- Page level custom scripts --}}
<script src="{{ asset('js/chart-area-demo.js') }}"></script>
@endsection
