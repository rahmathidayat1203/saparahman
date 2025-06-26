@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Role</h4>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @can('role-create')
                    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">
                        <i class="mdi mdi-plus"></i> Tambah Role
                    </a>
                @endcan

                <div class="table-responsive">
                    <table class="table table-striped" id="roles-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('role-edit')
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                        @endcan
                                        @can('role-delete')
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus role ini?')">
                                                    <i class="mdi mdi-delete"></i> Hapus
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {!! $roles->links('pagination::bootstrap-5') !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
