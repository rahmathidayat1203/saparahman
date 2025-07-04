@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Santri</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <a href="{{ route('santri.create') }}" class="btn btn-success mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Santri
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="santri-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Santri</th>
                                <th>NIS</th>
                                <th>NISN</th>
                                <th>NSM</th>
                                <th>NPSM</th>
                                <th>Tingkatan</th>
                                <th>Nama Kelas</th>
                                <th>Gender</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTable will populate this section dynamically -->
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
        $('#santri-table').DataTable({
            processing: true,
            serverSide: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍 Cari santri...",
                lengthMenu: "Tampilkan _MENU_ data",
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                }
            },
            ajax: '{{ route('santri.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama_santri', name: 'nama_santri' },
                { data: 'nis', name: 'nis' },
                { data: 'nisn', name: 'nisn' },
                { data: 'nsm', name: 'nsm' },
                { data: 'npsm', name: 'npsm' },
                { data: 'tingkatan', name: 'tingkatan' },
                { data: 'nama_kelas', name: 'nama_kelas' },
                { data: 'gender', name: 'gender' },
                { data: 'foto', name: 'foto', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
