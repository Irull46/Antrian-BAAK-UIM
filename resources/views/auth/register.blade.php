@extends('layouts.app', ['title' => 'Daftar'])

@section('content')
<div class="h-100 pt-80-sip">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-7 col-md-6 col-lg-5 col-xl-4">
                <div class="card p-sm-4 p-lg-5">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('images/BAAK Logo.png') }}" alt="BAAK Logo" height="70" class="mb-2">
                            <div class="fs-3 fw-bold">Daftar</div>
                            <div class="fs-5 mb-3">Buat Akun Sekarang</div>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-2">
                                <label for="name">Nama</label>
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name"
                                    value="{{ old('name') }}"
                                    autocomplete="name"
                                    required 
                                    autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="email">Email</label>
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    autocomplete="email"
                                    required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6 pe-md-1 mb-2 mb-md-0">
                                    <label for="password">Password</label>
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        autocomplete="new-password"
                                        required>
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 ps-md-1">
                                    <label for="passwordConfirm">Ulangi Password</label>
                                    <input
                                        id="passwordConfirm"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        autocomplete="new-password"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox">
                                    <label class="form-check-label" for="checkbox">Lihat Password</label>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-success w-100 mb-4">Daftar</button>
                                <div class="text-center text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold">Login</a></div>
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
    const passwordConfirm = document.getElementById("passwordConfirm");
    const checkbox = document.getElementById("checkbox");

    checkbox.addEventListener("click", () => {
        if (checkbox.checked) {
            password.type = "text";
            passwordConfirm.type = "text";
        } else {
            password.type = "password";
            passwordConfirm.type = "password";
        }
    });
</script>
@endsection
