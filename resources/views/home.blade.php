@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Grid Kiri --}}
        <div class="col-md-8 col-lg-9">
            {{-- Nomor Antrian --}}
            <div class="container-fluid">
                <div class="row bg-dark py-4 py-sm-5 mb-4">
                    <div class="col-md-8 pb-3 pb-md-0">
                        <div class="ms-md-5 bg-white border border-5">
                            <h2 class="py-2 bg-white border-bottom border-5 fw-bold text-center">Nomor Antrian</h2>
                            <div class="text-center m-0 py-3 py-sm-4 py-md-5 d-flex justify-content-center">
                                <h1 class="fw-bold" id="nomor_antrian">-</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="me-md-5 bg-white border border-5">
                            <h2 class="py-2 bg-white border-bottom border-5 fw-bold text-center">Teller</h2>
                            <h1 class="fw-bold text-center m-0 py-3 py-sm-4 py-md-5" id="posisi">-</h1>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- 5 Teller --}}
            <div class="row mb-4">
                <div class="col-md">
                    <div class="bg-dark pt-3 pb-1 px-2">
                        <h4 class="fw-bold text-center text-light">Teller 1</h4>
                    </div>
                    <div class="bg-secondary px-3 py-3">
                        <div class="fw-bold text-center d-flex justify-content-center">
                            <h1 id="nomor_antrian1">-</h1>
                        </div>
                        <h5 class="fw-bold text-center" id="nama1">-</h3>
                    </div>
                </div>
                <div class="col-md">
                    <div class="bg-dark pt-3 pb-1 px-2">
                        <h4 class="fw-bold text-center text-light">Teller 2</h4>
                    </div>
                    <div class="bg-secondary px-3 py-3">
                        <div class="fw-bold text-center d-flex justify-content-center">
                            <h1 id="nomor_antrian2">-</h1>
                        </div>
                        <h5 class="fw-bold text-center" id="nama2">-</h3>
                    </div>
                </div>
                <div class="col-md">
                    <div class="bg-dark pt-3 pb-1 px-2">
                        <h4 class="fw-bold text-center text-light">Teller 3</h4>
                    </div>
                    <div class="bg-secondary px-3 py-3">
                        <div class="fw-bold text-center d-flex justify-content-center">
                            <h1 id="nomor_antrian3">-</h1>
                        </div>
                        <h5 class="fw-bold text-center" id="nama3">-</h3>
                    </div>
                </div>
                <div class="col-md">
                    <div class="bg-dark pt-3 pb-1 px-2">
                        <h4 class="fw-bold text-center text-light">Teller 4</h4>
                    </div>
                    <div class="bg-secondary px-3 py-3">
                        <div class="fw-bold text-center d-flex justify-content-center">
                            <h1 id="nomor_antrian4">-</h1>
                        </div>
                        <h5 class="fw-bold text-center" id="nama4">-</h3>
                    </div>
                </div>
                <div class="col-md">
                    <div class="bg-dark pt-3 pb-1 px-2">
                        <h4 class="fw-bold text-center text-light">Teller 5</h4>
                    </div>
                    <div class="bg-secondary px-3 py-3">
                        <div class="fw-bold text-center d-flex justify-content-center">
                            <h1 id="nomor_antrian5">-</h1>
                        </div>
                        <h5 class="fw-bold text-center" id="nama5">-</h3>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Grid Kanan --}}
        <div class="col-md-4 col-lg-3">
            <div class="bg-dark pt-3 pb-1 px-2">
                <h4 class="fw-bold text-center text-light">Sisa Antrian A</h4>
            </div>
            <div class="bg-secondary px-3 py-3 mb-md-4">
                <h1 class="fw-bold text-center" id="sisaA">-</h1>
            </div>
            <div class="bg-dark pt-3 pb-1 px-2">
                <h4 class="fw-bold text-center text-light">Sisa Antrian B</h4>
            </div>
            <div class="bg-secondary px-3 py-3">
                <h1 class="fw-bold text-center" id="sisaB">-</h1>
            </div>
        </div>
    </div>
</div>

<script>
    setInterval(async function() {
        try {
            const response = await fetch('{{ route('home.ajax') }}', {
                method: 'GET'
            });
            if (response.ok) {
                const responseData = await response.json();

                document.getElementById("nomor_antrian").innerHTML = responseData.nomor_antrian;
                document.getElementById("posisi").innerHTML = responseData.posisi;
                document.getElementById("sisaA").innerHTML = responseData.sisaA;
                document.getElementById("sisaB").innerHTML = responseData.sisaB;
                
                document.getElementById("nomor_antrian1").innerHTML = responseData.nomor_antrian1;
                document.getElementById("nomor_antrian2").innerHTML = responseData.nomor_antrian2;
                document.getElementById("nomor_antrian3").innerHTML = responseData.nomor_antrian3;
                document.getElementById("nomor_antrian4").innerHTML = responseData.nomor_antrian4;
                document.getElementById("nomor_antrian5").innerHTML = responseData.nomor_antrian5;

                document.getElementById("nama1").innerHTML = responseData.nama1;
                document.getElementById("nama2").innerHTML = responseData.nama2;
                document.getElementById("nama3").innerHTML = responseData.nama3;
                document.getElementById("nama4").innerHTML = responseData.nama4;
                document.getElementById("nama5").innerHTML = responseData.nama5;
            } else {
                console.log('Data tidak ditemukan!');
            }
        } catch (error) {
            console.log(error);
        }
    }, 1000);
</script>
@endsection
