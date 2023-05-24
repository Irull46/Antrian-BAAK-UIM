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
        </div>
        
        {{-- Grid Kanan --}}
        <div class="col-md-4 col-lg-3">
            <div class="bg-dark pt-3 pb-1 px-2">
                <h4 class="fw-bold text-center text-light">Sisa Antrian <span id="bagian"></span></h4>
            </div>
            <div class="bg-secondary px-3 py-3 mb-md-4">
                <h1 class="fw-bold text-center" id="sisa">-</h1>
            </div>

            <div class="mt-2 d-flex flex-column">
                <button ondblclick="btnLanjuts()" onclick="btnLanjut()" class="btn btn-outline-success btn-lg click1 mb-2">LANJUT</button>
                <button onclick="panggil()" class="btn btn-outline-success btn-lg click1 mb-2">PANGGIL</button>
                <button onclick="btnSelesai()" class="btn btn-outline-success btn-lg click1 mb-2">SELESAI</button>
                <a href="{{ route('home.index') }}" class="btn btn-outline-success btn-lg click1 mb-2">KELUAR</a>
            </div>
        </div>
    </div>
</div>

<div class="audio">
    <audio id="bell_in" src="{{ asset('audio/in.mp3') }}"></audio>
    <audio id="bell_out" src="{{ asset('audio/out.mp3') }}"></audio>
    <audio id="nomorAntrian" src="{{ asset('audio/nomor antrian.mp3') }}"></audio>
    <audio id="bagian_A" src="{{ asset('audio/a.mp3') }}"></audio>
    <audio id="bagian_B" src="{{ asset('audio/b.mp3') }}"></audio>
    <audio id="nomor1" src="{{ asset('audio/1.mp3') }}"></audio>
    <audio id="nomor2" src="{{ asset('audio/2.mp3') }}"></audio>
    <audio id="nomor3" src="{{ asset('audio/3.mp3') }}"></audio>
    <audio id="nomor4" src="{{ asset('audio/4.mp3') }}"></audio>
    <audio id="nomor5" src="{{ asset('audio/5.mp3') }}"></audio>
    <audio id="nomor6" src="{{ asset('audio/6.mp3') }}"></audio>
    <audio id="nomor7" src="{{ asset('audio/7.mp3') }}"></audio>
    <audio id="nomor8" src="{{ asset('audio/8.mp3') }}"></audio>
    <audio id="nomor9" src="{{ asset('audio/9.mp3') }}"></audio>
    <audio id="nomor10" src="{{ asset('audio/10.mp3') }}"></audio>
    <audio id="nomor11" src="{{ asset('audio/11.mp3') }}"></audio>
    <audio id="nomor100" src="{{ asset('audio/100.mp3') }}"></audio>
    <audio id="belas" src="{{ asset('audio/belas.mp3') }}"></audio>
    <audio id="puluh" src="{{ asset('audio/puluh.mp3') }}"></audio>
    <audio id="ratus" src="{{ asset('audio/ratus.mp3') }}"></audio>
    <audio id="teller1" src="{{ asset('audio/teller1.mp3') }}"></audio>
    <audio id="teller2" src="{{ asset('audio/teller2.mp3') }}"></audio>
    <audio id="teller3" src="{{ asset('audio/teller3.mp3') }}"></audio>
    <audio id="teller4" src="{{ asset('audio/teller4.mp3') }}"></audio>
    <audio id="teller5" src="{{ asset('audio/teller5.mp3') }}"></audio>
</div>

<script>
    setInterval(async function() {
        const user_id = "{{ Auth::user()->id }}";

        try {
            const response = await fetch('{{ route('panggil.ajax') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    _token: "{{ csrf_token() }}",
                    id: user_id,
                }),
            });
            if (response.ok) {
                const responseData = await response.json();

                document.getElementById("nomor_antrian").innerHTML = responseData.nomor_antrian;
                document.getElementById("bagian").innerHTML = responseData.bagian;
                document.getElementById("posisi").innerHTML = responseData.posisi;

                if (responseData.bagian === 'A'){
                    document.getElementById("sisa").innerHTML = responseData.sisaA;
                } else {
                    document.getElementById("sisa").innerHTML = responseData.sisaB;
                }
            } else {
                console.log('Data tidak ditemukan!');
            }
        } catch (error) {
            console.log(error);
        }
    }, 1000);

    async function btnLanjut() {
        const user_id = "{{ Auth::user()->id }}";
        let nomor_antrian = document.getElementById('nomor_antrian').innerText;

        try {
            const response = await fetch("{{ route('panggil.lanjut') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    _token: "{{ csrf_token() }}",
                    id: user_id,
                    nomor_antrian: nomor_antrian,
                }),
            });
            if (response.ok) {
                const responseData = await response.json();
                console.log(responseData.message);
            } else {
                const errorText = await response.text();
                console.log(errorText);
            }
        } catch (error) {
            console.error('Terjadi kesalahan:', error);
        }
    }

    function btnLanjuts() {
        console.log('');
    }

    async function btnSelesai() {
        let nomor_antrian = document.getElementById('nomor_antrian').textContent;

        try {
            const response = await fetch('{{ route('panggil.selesai') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    _token: "{{ csrf_token() }}",
                    nomor_antrian: nomor_antrian,
                 })
            });
            if (response.ok) {
                const responseData = await response.json();
                console.log(responseData.nomor_antrian);
            } else {
                const errorText = await response.text();
                console.log(errorText);
            }
        } catch (error) {
            console.log(error);
        }
    };
</script>

<script src="{{ asset('js/call.js') }}"></script>
@endsection
