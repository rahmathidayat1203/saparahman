@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Kasus</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('kasus.create') }}" class="btn btn-primary mb-3">
                        <i class="mdi mdi-plus"></i> Tambah Kasus
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="kasus-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Tanggal Kejadian</th>
                                    <th>Keterangan</th>
                                    <th>Deskripsi Penyelesaian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- DataTables akan mengisi secara otomatis --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function() {
                $('#kasus-table').DataTable({
                    processing: true,
                    serverSide: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "🔍 Cari kasus...",
                        lengthMenu: "Tampilkan _MENU_ data",
                        paginate: {
                            previous: "&laquo;",
                            next: "&raquo;"
                        }
                    },
                    ajax: '{{ route('kasus.index') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'jenis_pelanggaran',
                            name: 'jenis_pelanggaran'
                        },
                        {
                            data: 'tgl_kejadian',
                            name: 'tgl_kejadian'
                        },
                        {
                            data: 'ket_pelanggaran',
                            name: 'ket_pelanggaran'
                        },
                        {
                            data: 'desc_penyelesaian',
                            name: 'desc_penyelesaian'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>
    @endpush
@endsection
