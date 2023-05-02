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
                                <h6 class="text-light">: Jhon Doe</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-2">
                                <h6 class="text-light fw-bold">Tanggal lahir</h6>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <h6 class="text-light">: 05 Februari 1999</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-2">
                                <h6 class="text-light fw-bold">Alamat</h6>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <h6 class="text-light">: Pakamban Daya</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-2">
                                <h6 class="text-light fw-bold">Jenis kelamin</h6>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <h6 class="text-light">: Laki-laki</h6>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#form">Edit</button>
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
                            <div class="mb-2">
                                <input value="{{ old('id', Auth::user()->id) }}" id="id" type="hidden" class="form-control" name="id" required>
                            </div>
                            <div class="mb-2">
                                <label for="name">Nama Lengkap</label>
                                <input value="{{ old('name', Auth::user()->name) }}" id="name" type="text" class="form-control" name="name" required disabled>
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
                                        <input class="form-check-input" type="radio" value="laki-laki" name="jenis_kelamin" id="Laki-Laki">
                                        <label class="form-check-label" for="Laki-Laki">Laki-Laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="perempuan" name="jenis_kelamin" id="Perempuan">
                                        <label class="form-check-label" for="Perempuan">Perempuan</label>
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
@endsection