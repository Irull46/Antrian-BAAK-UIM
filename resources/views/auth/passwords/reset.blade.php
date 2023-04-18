@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-5">
                <div class="card p-sm-4 p-lg-5">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/BAAK Logo.png') }}" alt="BAAK Logo" height="70" class="mb-2">
                            <div class="fs-3 fw-bold">Setel Ulang Password</div>
                            <div class="fs-5 mb-4">Masukkan email dan password untuk menyetel ulang password</div>
                        </div>
                        
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-2">
                                <label for="email">Alamat Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6 pe-md-1">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 ps-md-1">
                                    <label for="password-confirm">Ulangi Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Setel Ulang Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
