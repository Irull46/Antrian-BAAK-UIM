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
        <div class="row d-flex justify-content-between">
            <div class="col-md">
                <div class="fs-3 fw-bold">Nomor Antrian</div>
                <div class="fs-5 mb-3">Membuat/Menghapus Nomor Antrian.</div>
            </div>
            <div class="col-md">
                <div class="mt-2 mb-4 mb-md-0 float-md-end">
                    <a class="btn btn-warning click3" href="{{ route('cetak.clear') }}" role="button">Hapus Antrian</a>
                    <button type="button" class="btn btn-success click1" data-bs-toggle="modal" data-bs-target="#form">Buat Antrian</button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>No. Urut</th>
                        <th>No. Antrian</th>
                        <th>Dibuat</th>
                        <th>Diubah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->sortBy('nomor_antrian') as $antrian)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $antrian->nomor_antrian }}</td>
                            <td>{{ $antrian->created_at->format('H:i') }}</td>
                            <td>{{ $antrian->updated_at->format('H:i') }}</td>
                            <td>{{ ucfirst($antrian->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Buat Antrian</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('cetak.cetak') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-8 pe-md-2 mb-2 mb-md-0">
                                    <label for="jumlah_antrian">Jumlah</label>
                                    <input
                                        type="text"
                                        class="form-control @error('jumlah_antrian') is-invalid @enderror"
                                        id="jumlah_antrian"
                                        name="jumlah_antrian"
                                        placeholder="Input jumlah">

                                    @error('jumlah_antrian')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 ps-md-0">
                                    <label for="bagian">Bagian</label>
                                    <select class="form-select @error('bagian') is-invalid @enderror" id="bagian" name="bagian" required>
                                        <option value="" selected>Pilih</option>
                                        <option value="A">BAAK</option>
                                        <option value="B">BAUK</option>
                                        <option value="AB">SEMUA</option>
                                    </select>

                                    @error('bagian')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
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
    document.getElementById('form').addEventListener('shown.bs.modal', function () {
        const input = document.getElementById('jumlah_antrian');
        input.focus();
        input.required = true;
    });
</script>
@endsection