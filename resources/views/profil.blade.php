@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="fs-3 fw-bold pb-2 border-bottom">Profil Pengguna</div>
        <div class="fs-5 mb-3">Lengkapi data-datamu setelah membuat akun.</div>

        <div class="container">
            <div class="row bg-success p-5 rounded">
                <div class="col-md-4 col-lg-2">
                    <div class="me-4">
                        <img src="{{ asset('images/avatar.jpg') }}" alt="avatar" height="150" class="rounded-circle">
                    </div>
                </div>
                <div class="col">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-lg-2">
                                <h6 class="text-light fw-bold">Nama Lengkap</h6>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <h6 class="text-light">: {{ old('name', Auth::user()->name) }}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-2">
                                <h6 class="text-light fw-bold">Tanggal lahir</h6>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <h6 class="text-light">: <span id="h6_tanggal_lahir"></span></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-2">
                                <h6 class="text-light fw-bold">Alamat</h6>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <h6 class="text-light">: <span id="h6_alamat"></span></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-2">
                                <h6 class="text-light fw-bold">Jenis kelamin</h6>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <h6 class="text-light">: <span id="h6_jenis_kelamin"></span></h6>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-light click2" data-bs-toggle="modal" data-bs-target="#form" id="edit">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Edit Profil</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('profil.update') }}">
                        @method("patch")
                        @csrf
                        <div class="modal-body">
                            <input value="{{ old('id', Auth::user()->id) }}" type="hidden" class="form-control" name="id" required>
                            <div class="mb-2">
                                <label for="name">Nama Lengkap</label>
                                <input value="{{ old('name', Auth::user()->name) }}" id="name" type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-2">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input id="tanggal_lahir" type="date" class="form-control" name="tanggal_lahir" required>
                            </div>
                            <div class="mb-2">
                                <label for="alamat">Alamat</label>
                                <input id="alamat" type="text" class="form-control" name="alamat" required>
                            </div>
                            <div class="mb-2">
                                <label>Jenis Kelamin</label>
                                <div class="d-flex">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" value="Laki-Laki" name="jenis_kelamin" id="laki-laki">
                                        <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Perempuan" name="jenis_kelamin" id="perempuan">
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>        
        $(document).ready(function() {
            async function profil() {
                const user_id = "{{ Auth::user()->id }}";

                try {
                    const response = await fetch("{{ route('profil.ajax') }}", {
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

                        // Halaman Profil
                        document.getElementById("h6_tanggal_lahir").innerHTML = responseData.tanggal_lahir;
                        document.getElementById("h6_alamat").innerHTML = responseData.alamat;
                        document.getElementById("h6_jenis_kelamin").innerHTML = responseData.jenis_kelamin;

                        // Form edit profil
                        if (responseData.jenis_kelamin === 'Laki-Laki') {
                            document.querySelector('input[value="Laki-Laki"]').checked = true;
                        } else {
                            document.querySelector('input[value="Perempuan"]').checked = true;
                        }

                        document.getElementById('tanggal_lahir').value = responseData.tanggal_lahir;
                        document.getElementById('alamat').value = responseData.alamat;
                    } else {
                        const errorText = await response.text();
                        console.log(errorText);
                    }
                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                }
            }
 
            profil();
        });
    </script>
@endsection