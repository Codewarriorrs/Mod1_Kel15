@extends('admin.layout')
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h4 class="mt-5 ">Data Admin</h4>
    <a href="{{ route('admin.trash') }}" type="button" class="btn btn-outline-secondary fw-bold rounded-3">Trash</a>
</div>
    <a href="{{ route('admin.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif
    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>No.<a href="?sort=id_admin&order=asc" class="text-dark text-decoration-none fw-bold">↑ </a><a href="?sort=id_admin&order=desc" class="text-dark text-decoration-none">↓</a></th>
                <th>Nama <a href="?sort=nama&order=asc" class="text-dark text-decoration-none fw-bold">↑ </a><a href="?sort=nama&order=desc" class="text-dark text-decoration-none">↓</a></th>
                <th>Alamat</th>
                <th>Username <a href="?sort=username&order=asc" class="text-dark text-decoration-none fw-bold">↑ </a><a href="?sort=username&order=desc" class="text-dark text-decoration-none">↓</a></th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        
            @foreach ($datas as $data)
                <tr>
                    
                                        
                    <td>{{ $data->id_admin }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->alamat }}</td>
                    <td>{{ $data->username }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $data->id_admin) }}" type="button"
                            class="btn btn-warning rounded-3">Ubah</a>

                        {{-- tombol delete --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#hapusModal{{ $data->id_admin }}">
                            Hapus
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="hapusModal{{ $data->id_admin }}" tabindex="-1"
                            aria-labelledby="hapusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.delete', $data->id_admin) }}">
                                        @csrf
                                        <div class="modal-body">
                                            Apakah anda yakin ingin
                                            menghapus data ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Ya</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </td>
                </tr>
            @endforeach
        </tbody>
</table> @stop
