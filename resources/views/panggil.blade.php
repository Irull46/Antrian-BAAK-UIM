@extends('layouts.app')

@section('content')
<div class="h-100 pt-80-sip">
    <div class="container-fluid">
        <div class="row">
            {{-- Left Column --}}
            <div class="col-md-8 col-lg-9">
                <div class="container-fluid">
                    <div class="row bg-success py-3 py-md-5 mb-2">
                        <div class="col-md-8 pb-2 pb-md-0">
                            <div class="ms-md-5 bg-white border border-5">
                                <h2 class="py-2 bg-white border-bottom border-5 fw-bold text-center">Nomor Antrian</h2>
                                <h1 class="m-0 py-2 py-sm-3 py-md-4 text-center fw-bold" id="nomor_antrian">-</h1>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="me-md-5 bg-white border border-5">
                                <h2 class="py-2 bg-white border-bottom border-5 fw-bold text-center">Teller</h2>
                                <h1 class="m-0 py-2 py-sm-3 py-md-4 text-center fw-bold" id="posisi">-</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Right Column --}}
            <div class="col-md-4 col-lg-3">
                <div class="bg-success pt-3 pb-1 px-2">
                    <h4 class="fw-bold text-center text-light">Sisa Antrian <span id="bagian"></span></h4>
                </div>
                <div class="bg-white px-3 py-3 mb-md-4">
                    <h1 class="fw-bold text-center" id="sisa">-</h1>
                </div>

                <div class="mt-2 d-flex flex-column">
                    <button ondblclick="btnLanjuts()" onclick="btnLanjut()" class="btn btn-outline-success btn-lg click1 mb-2">LANJUT</button>
                    <button onclick="btnPanggil()" class="btn btn-outline-success btn-lg click1 mb-2">PANGGIL</button>
                    <button onclick="btnSelesai()" class="btn btn-outline-success btn-lg click1 mb-2">SELESAI</button>
                    <a href="{{ route('home.index') }}" class="btn btn-outline-success btn-lg click1 mb-2">KELUAR</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get Queue Number, Teller Position, and Rest of The Queue
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


    // Change Queue Status 'Menunggu' or 'Terlambat' to 'Proses', 'Proses' to 'Terlambat' and Save Start Time to Traffic Table
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


    // If There is a Double Click
    function btnLanjuts() {
        console.log('');
    }


    // Send Event (CallExecute Event)
    async function btnPanggil() {
        let nomor_antrian = document.getElementById('nomor_antrian').innerText;
        let bagian = nomor_antrian.charAt(0);
        let nomor = nomor_antrian.slice(1);
        let posisi = document.getElementById("posisi").innerText;
        
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
            if (response.ok) {
                const responseData = await response.json();
                console.log(responseData);
            }
        } catch (error) {
            console.log(error);
        }
    }


    // Change Queue Status 'Proses' to 'Selesai', Save Finishing Time to Traffic Table and Clear Queue Data from Antrian table
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
@endsection
