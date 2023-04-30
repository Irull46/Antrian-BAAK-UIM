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
                            <button class="btn btn-light">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom">Columns with icons</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="feature col">
                <div class="feature-icon bg-primary bg-gradient">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"/></svg>
                </div>
                <h2>Featured title</h2>
                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                <a href="#" class="icon-link">
                Call to action
                <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
                </a>
            </div>
            <div class="feature col">
                <div class="feature-icon bg-primary bg-gradient">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
                </div>
                <h2>Featured title</h2>
                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                <a href="#" class="icon-link">
                Call to action
                <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
                </a>
            </div>
            <div class="feature col">
                <div class="feature-icon bg-primary bg-gradient">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
                </div>
                <h2>Featured title</h2>
                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                <a href="#" class="icon-link">
                Call to action
                <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
                </a>
            </div>
            </div>
        </div> --}}
    </div>
@endsection