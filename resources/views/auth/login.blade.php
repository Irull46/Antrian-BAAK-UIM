@extends('layouts.app')

@section('content')
<div class="h-100 pt-80-sip">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-7 col-md-6 col-lg-5 col-xl-4">
                <div class="card p-sm-4 p-lg-5">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/BAAK Logo.png') }}" alt="BAAK Logo" height="70" class="mb-2">
                            <div class="fs-3 fw-bold">Login</div>
                            <div class="fs-5 mb-3">Gunakan Akun Anda</div>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-2">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                
                            <div class="mb-2">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox">
                                    <label class="form-check-label" for="checkbox">Lihat Password</label>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-success w-100 mb-4">Login</button>
                                <div class="text-center text-muted">Belum punya akun? <a href="{{ route('register') }}" class="fw-bold">Daftar</a></div>
                            </div>
                            
                            @include('partials.createdby')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const password = document.getElementById("password");
    const checkbox = document.getElementById("checkbox");

    checkbox.addEventListener("click", () => {
        if (checkbox.checked) {
            password.type = "text";
        } else {
            password.type = "password";
        }
    });
</script>
@endsection
