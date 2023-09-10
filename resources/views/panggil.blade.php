@extends('layouts.app', ['title' => 'Panggil Antrian'])

@section('content')
<div class="h-100 pt-80-sip">
    <div class="row">
        {{-- Left Column --}}
        <div class="col-md-8 col-lg-9">
            {{-- <div class="container-fluid"> --}}
                <div class="bg-success p-3 p-md-5 mb-2 mb-md-0">
                    {{-- <div class="col-md-8 pb-2 pb-md-0"> --}}
                        <div class="bg-white border border-5">
                            <h2 class="py-2 border-bottom border-5 fw-bold text-center">Nomor Antrian</h2>
                            <h1 class="m-0 py-2 py-sm-3 py-md-4 text-center fw-bold" id="nomor_antrian">-</h1>
                        </div>
                    {{-- </div> --}}
                    {{-- <div class="col-md-4"> --}}
                        <div class="me-md-5 bg-white border border-5 d-none">
                            <h2 class="py-2 border-bottom border-5 fw-bold text-center">Menuju</h2>
                            <h1 class="m-0 py-2 py-sm-3 py-md-4 text-center fw-bold" id="posisi">-</h1>
                        </div>
                    {{-- </div> --}}
                </div>
            {{-- </div> --}}
        </div>
        
        {{-- Right Column --}}
        <div class="col-md-4 col-lg-3 d-md-flex flex-column justify-content-between">
            <div>
                <div class="bg-success pt-3 pb-1 px-2">
                    <h4 class="fw-bold text-center text-light">Sisa Antrian <span id="bagian"></span></h4>
                </div>
                <div class="bg-warning px-3 py-3 mb-md-4">
                    <h1 class="fw-bold text-center" id="sisa">-</h1>
                </div>
            </div>
            
            <div>
                <div class="mt-4 mt-md-2 d-flex flex-column">
                    <div class="d-flex mb-3 mb-md-2">
                        <button id="btnk" onclick="btnKembali()" class="btn btn-warning btn-lg click3 w-50 me-1">KEMBALI</button>
                        <button id="btnl" onclick="btnLanjut()" class="btn btn-success btn-lg click1 w-50 ms-1">LANJUT</button>
                    </div>
                    <button onclick="btnPanggil()" class="btn btn-success btn-lg click1 mb-3 mb-md-2">PANGGIL ULANG</button>
                    <button onclick="btnSelesai()" class="btn btn-outline-success btn-lg click1">SELESAI</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setInterval(async function() {
        try {
            const response = await fetch("{{ route('panggil.ajax') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    _token: "{{ csrf_token() }}",
                }),
            });
            if (response.ok) {
                const responseData = await response.json();

                document.getElementById("nomor_antrian").innerHTML = responseData.nomor_antrian;
                document.getElementById("bagian").innerHTML = responseData.bagian;
                document.getElementById("posisi").innerHTML = (responseData.posisi === '1') ? 'BAAK' : 'BAUK';
                document.getElementById("sisa").innerHTML = (responseData.bagian === 'A') ? responseData.sisaA : responseData.sisaB;
            }
        } catch (error) {
            console.log(error);
        }
    }, 1000);


    async function btnKembali() {
        const btn = document.getElementById('btnk');
        btn.setAttribute('disabled', true);

        try {
            const response = await fetch("{{ route('panggil.kembali') }}");
            if (response.ok) {
                setTimeout(() => {
                    btn.removeAttribute('disabled');
                }, 500);
            }
        } catch (error) {
            console.error('Terjadi kesalahan:', error);
            btn.removeAttribute('disabled');
        }
    }
    

    async function btnLanjut() {
        const btn = document.getElementById('btnl');
        btn.setAttribute('disabled', true);

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
                setTimeout(() => {
                    btn.removeAttribute('disabled');
                }, 500);
                setTimeout(btnPanggil, 1000);
            }
        } catch (error) {
            console.error('Terjadi kesalahan:', error);
            btn.removeAttribute('disabled');
        }
    }


    async function btnPanggil() {
        let nomor_antrian = document.getElementById('nomor_antrian').innerText;
        let bagian = nomor_antrian.charAt(0);
        let nomor = nomor_antrian.slice(1);
        let posisi = document.getElementById("posisi").innerText;
        posisi = (posisi == 'BAAK') ? 1 : 2;
        
        if (bagian == '-'|| nomor == null){
            alert('Klik tombol "LANJUT" sebelum memanggil!');
        } else {
            try {
                const response = await fetch('./call', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        _token: "{{ csrf_token() }}",
                        bagian: bagian,
                        nomor: nomor,
                        posisi: posisi,
                    }),
                });
            } catch (error) {
                console.log(error);
            }
        }
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
        } catch (error) {
            console.log(error);
        }
    };
</script>
@endsection
