@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Jenis Fiqih</h4>
                <p class="card-description">List semua jenis fiqih yang tersedia</p>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('fiqih.create') }}" class="btn btn-primary mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Jenis Fiqih
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="fiqih-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Fiqih</th>
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
    $(function () {
        $('#fiqih-table').DataTable({
            processing: true,
            serverSide: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍 Cari jenis fiqih...",
                lengthMenu: "Tampilkan _MENU_ data",
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                }
            },
            ajax: '{{ route('fiqih.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'jenis_fiqih', name: 'jenis_fiqih' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
