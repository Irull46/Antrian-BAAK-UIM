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
        <div class="fs-3 fw-bold">Role Manajemen</div>
        <div class="fs-5 mb-3">Mengatur Role/Peran Pengguna.</div>

        <div class="table-responsive">
            <table id="myTable" class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @foreach ($user->roles as $role)
                                <td>{{ ucfirst($role->name) }}</td>
                            @endforeach
                            @foreach ($posisi_teller as $posisi)
                                @if ($posisi->user_id == $user->id)
                                    <td class="d-none">{{ $posisi->bagian }}</td>
                                @endif
                            @endforeach
                            <td class="d-flex">
                                <button type="button" class="btn btn-success me-1 click1 btn-edit {{ $user->hasRole('admin') ? 'disabled' : '' }}" data-bs-toggle="modal" data-bs-target="#form" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $role->name }}" data-bagian="{{ $posisi->bagian }}">Edit</button>
                                
                                <form action="{{ route('role.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning click3 btn-delete {{ $user->hasRole('admin') ? 'disabled' : '' }}">Reset</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Edit Role Pengguna</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('role.update') }}">
                        @method("patch")
                        @csrf
                        <div class="modal-body">
                            <div>
                                <input id="user_id" type="hidden" class="form-control" name="user_id" required>
                            </div>
                            <div class="mb-2">
                                <label for="nama">Nama</label>
                                <input id="nama" type="text" class="form-control" name="nama" required disabled>
                            </div>
                            <div class="mb-2">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" required disabled>
                            </div>
                            <div class="mb-2">
                                <label for="role">Role</label>
                                <select class="form-select" name="role" id="role" onchange="toggleSecondSelect()" required>
                                    <option value="" selected>Pilih</option>
                                    <option value="teller">Teller</option>
                                    <option value="pengunjung">Pengunjung</option>
                                </select>
                            </div>

                            <div class="mb-2 d-none" id="show-hide">
                                <label for="bagian">Bagian</label>
                                <select class="form-select" name="bagian" id="bagian" required>
                                    <option value="" selected>Pilih</option>
                                    <option value="A">BAAK</option>
                                    <option value="B">BAUK</option>
                                </select>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        const formModal = document.getElementById('form');
        const modalTrigger = document.querySelector('[data-toggle="modal"]');
        const userIdInput = document.getElementById('user_id');
        const nameInput = document.getElementById('nama');
        const emailInput = document.getElementById('email');
        const roleSelect = document.getElementById('role');
        const bagianSelect = document.getElementById('bagian');

        formModal.addEventListener('shown.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.dataset.id;
            const nama = button.dataset.name;
            const email = button.dataset.email;
            const role = button.dataset.role;
            const bagian = button.dataset.bagian;

            userIdInput.value = id;
            nameInput.value = nama;
            emailInput.value = email;

            if (role === 'admin') {
                roleSelect.value = 'admin';
            } else if (role === 'teller') {
                roleSelect.value = 'teller';
                bagianSelect.value = (bagian == 'A') ? 'A' : 'B';
            } else {
                roleSelect.value = 'pengunjung';
            }
            toggleSecondSelect();
        });
    });

    function toggleSecondSelect() {
        const role = document.getElementById('role');
        const show_hide = document.getElementById('show-hide');

        if (role.value === 'teller') {
            show_hide.classList.remove('d-none');
        } else {
            show_hide.classList.add('d-none');
        }
    }
</script>
@endsection