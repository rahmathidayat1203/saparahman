@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Tahfidz</h4>
                    <p class="card-description">Data seluruh tahfidz santri</p>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('tahfidz.create') }}" class="btn btn-primary mb-3">
                        <i class="mdi mdi-plus"></i> Tambah Tahfidz
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="tahfidz-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Tahfidz</th>
                                    <th>Arti</th>
                                    <th>Juz/Ayat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody> {{-- Diisi otomatis oleh DataTables --}}
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
            $('#tahfidz-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('tahfidz.index') }}',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "🔍 Cari data tahfidz...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "&laquo;",
                        next: "&raquo;"
                    },
                    zeroRecords: "Tidak ditemukan data yang sesuai"
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'jenis_tahfidz', name: 'jenis_tahfidz' },
                    { data: 'arti', name: 'arti' },
                    { data: 'juz_ayat', name: 'juz_ayat' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
