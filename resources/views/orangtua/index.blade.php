@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Orang Tua</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('orangtua.create') }}" class="btn btn-success mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Orang Tua
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="orangtua-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Orang Tua</th>
                                <th>No KK</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Pekerjaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Diisi oleh DataTables melalui Ajax -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#orangtua-table').DataTable({
        processing: true,
        serverSide: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "🔍 Cari orang tua...",
            lengthMenu: "Tampilkan _MENU_ data",
            paginate: {
                previous: "&laquo;",
                next: "&raquo;"
            }
        },
        ajax: '{{ route('orangtua.index') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_ortu', name: 'nama_ortu' },
            { data: 'no_kk', name: 'no_kk' },
            { data: 'no_telepon', name: 'no_telepon' },
            { data: 'alamat', name: 'alamat' },
            { data: 'pekerjaan', name: 'pekerjaan' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush
