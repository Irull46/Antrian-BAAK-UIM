@extends('layouts.app')

@section('content')
<div class="h-100 pt-80-sip">
    @if(session('message'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body rounded">
                        <div class="container">
                            <div class="row">
                                <div class="col-11">
                                    <p class="text-success m-0">{{ session('message') }}</p>
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#successModal').modal('show');
            });
        </script>
    @endif

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-5">
                <div class="card p-sm-4 p-lg-5">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/BAAK Logo.png') }}" alt="BAAK Logo" height="70" class="mb-2">
                            <div class="fs-3 fw-bold ">Cetak Antrian</div>
                            <div class="fs-5 mb-4">Masukkan jumlah antrian</div>
                        </div>
                        <form method="post" action="{{ route('cetak.cetak') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-8 pe-md-2 mb-2 mb-md-0">
                                    <label for="jumlah_antrian">Jumlah</label>
                                    <input
                                        type="text"
                                        class="form-control @error('jumlah_antrian') is-invalid @enderror"
                                        id="jumlah_antrian"
                                        name="jumlah_antrian"
                                        placeholder="Input jumlah">

                                    @error('jumlah_antrian')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 ps-md-0">
                                    <label for="bagian">Bagian</label>
                                    <select class="form-select @error('bagian') is-invalid @enderror" id="bagian" name="bagian">
                                        <option selected>Pilih</option>
                                        <option value="A">BAAK</option>
                                        <option value="B">BAUK</option>
                                        <option value="AB">SEMUA</option>
                                    </select>

                                    @error('bagian')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success click1 w-100">Cetak</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection