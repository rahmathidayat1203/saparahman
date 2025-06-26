@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Surah</h4>
                    <p class="card-description">Data seluruh surah dalam sistem</p>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('surah.create') }}" class="btn btn-primary mb-3">
                        <i class="mdi mdi-plus"></i> Tambah Surah
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="surah-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Surah</th>
                                    <th>Arti</th>
                                    <th>Jumlah Ayat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody> {{-- DataTables akan mengisi ini --}}
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
            $('#surah-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('surah.index') }}',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "🔍 Cari surah...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "&laquo;",
                        next: "&raquo;"
                    },
                    zeroRecords: "Tidak ditemukan data yang cocok"
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama_surah', name: 'nama_surah' },
                    { data: 'arti_surah', name: 'arti_surah' },
                    { data: 'jml_ayat', name: 'jml_ayat' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
