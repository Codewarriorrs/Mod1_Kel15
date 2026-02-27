@extends('admin.layout')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="mt-5 ">Trash Data Admin</h4>
        <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
    </div>


    @if ($datas->count() > 0)
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUndoAll">
            Restore All Data
        </button>
    @elseif ($datas->count() == 0)
        <h5 class="my-5 text-center">What are you looking for dude!</h5>
    @endif
    <div class="modal fade" id="modalUndoAll" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">Are you sure to restore all data?</div>
                <div class="modal-body">
                    You will restore <strong>ALL</strong> data admin from trash?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('admin.restoreAll') }}" class="btn btn-primary">Yes, Restore All</a>
                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif
    @if ($datas->count() > 0)
    <table class="table table-hover mt-2">
        <thead>
            <tr>

                <th>No.<a href="?sort=id_admin&order=asc" class="text-dark text-decoration-none fw-bold">↑ </a><a
                        href="?sort=id_admin&order=desc" class="text-dark text-decoration-none">↓</a></th>
                <th>Nama <a href="?sort=nama&order=asc" class="text-dark text-decoration-none fw-bold">↑ </a><a
                        href="?sort=nama&order=desc" class="text-dark text-decoration-none">↓</a></th>
                <th>Alamat</th>
                <th>Username <a href="?sort=username&order=asc" class="text-dark text-decoration-none fw-bold">↑ </a><a
                        href="?sort=username&order=desc" class="text-dark text-decoration-none">↓</a></th>
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
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#modalUndo{{ $data->id_admin }}">
                            Restore
                        </button>

                        <div class="modal fade" id="modalUndo{{ $data->id_admin }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">Konfirmasi Restore</div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin mengembalikan data <strong>{{ $data->nama }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <a href="{{ route('admin.restore', $data->id_admin) }}" class="btn btn-success">Ya,
                                            Kembalikan</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- tombol delete --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDelete{{ $data->id_admin }}">
                            Delete Permanently 
                        </button>

                        <div class="modal fade" id="confirmDelete{{ $data->id_admin }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">WARNING!</div>
                                    <div class="modal-body">
                                        Are you really want to delete <b>{{ $data->nama }}</b>? This data can't be restored
                                        again.
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('admin.forceDelete', $data->id_admin) }}" method="POST">
                                            @csrf
                                            @method('DELETE') <button type="submit" class="btn btn-danger">Yes, Delete
                                                Permanently</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </td>
                </tr>
            @endforeach
        </tbody>
</table>
@endif
@stop
