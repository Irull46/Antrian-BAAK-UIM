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
        <div class="fs-3 fw-bold">Role Manajemen</div>
        <div class="fs-5 mb-3">Mengatur Role/Peran Pengguna</div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>

        <form method="post" action="{{ route('role.update') }}">
            @method("patch")
            @csrf
            <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Edit Role Pengguna</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
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
                                <select class="form-select" name="role" id="role">
                                    <option value="admin">Admin</option>
                                    <option value="teller">Teller</option>
                                    <option value="pengunjung">Pengunjung</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('role.datatable') }}",
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row) {
                            let link = '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#form" data-id="' + row.id + '" data-nama="' + row.name + '" data-email="' + row.email + '">Edit Role</button>';
                            return link;
                        }
                    }

                ]
            });
        });

        $('#form').on('shown.bs.modal', function (event){
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let nama = button.data('nama');
            let email = button.data('email');

            let modal = $(this);
            modal.find('#user_id').val(id);
            modal.find('#nama').val(nama);
            modal.find('#email').val(email);
        });

    </script>
@endsection