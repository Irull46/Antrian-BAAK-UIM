@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body rounded">
                        <div class="container">
                            <div class="row">
                                <div class="col-11">
                                    <p class="text-success m-0">{{ session('success') }}</p>
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
                            <div class="fs-5 mb-3">Masukkan jumlah antrian yang akan dicetak</div>
                        </div>
                        <form method="post" action="{{ route('cetak.cetak') }}">
                            @csrf
                            <div>
                                <input type="text" class="form-control @error('jumlah_antrian') is-invalid @enderror" id="jumlah_antrian" name="jumlah_antrian" placeholder="Input jumlah">
                                @error('jumlah_antrian')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <button type="submit" class="btn btn-success w-100 mt-3">Cetak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection