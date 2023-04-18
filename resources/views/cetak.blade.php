@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-4">
                <div class="card p-5">
                    <div class="text-center">
                        <img src="{{ asset('images/BAAK Logo.png') }}" alt="BAAK Logo" height="70" class="mb-2">
                        <div class="fs-3 fw-bold ">Cetak Antrian</div>
                        <div class="fs-5 mb-3">Masukkan jumlah antrian yang akan dicetak</div>
                    </div>
        
                    <div class="card-body">
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