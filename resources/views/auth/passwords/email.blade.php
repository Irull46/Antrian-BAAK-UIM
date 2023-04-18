@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
            <div class="col-sm-7 col-md-6 col-lg-5 col-xl-4">
                <div class="card p-sm-4 p-lg-5">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/BAAK Logo.png') }}" alt="BAAK Logo" height="70" class="mb-2">
                            <div class="fs-3 fw-bold">Setel Ulang Password</div>
                            <div class="fs-5 mb-4">Masukkan email untuk menyetel ulang password</div>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Alamat Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Kirim Tautan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
