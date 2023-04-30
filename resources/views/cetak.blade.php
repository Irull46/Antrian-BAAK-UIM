@extends('layouts.app')

@section('content')
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
            
                        <form>
                            <div>
                                <input type="text" class="form-control mb-3" id="cetakAntrian" placeholder="Input jumlah">
                                <button type="submit" class="btn btn-success w-100">Cetak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection