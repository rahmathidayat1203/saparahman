@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Kategori Mading</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('kategori-mading.create') }}" class="btn btn-primary btn-sm mb-4">
                    <i class="mdi mdi-plus"></i> Tambah Kategori
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="kategori-mading-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#kategori-mading-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('kategori-mading.index') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kategori', name: 'kategori' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
