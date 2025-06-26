@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Kalender Akademik</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('kalender_akademik.create') }}" class="btn btn-primary mb-3">
                        <i class="mdi mdi-plus"></i> Tambah Kalender Akademik
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="kalender-akademik-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Libur Akademik</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
            $('#kalender-akademik-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('kalender_akademik.index') }}',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "🔍 Cari kalender...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    paginate: {
                        previous: "&laquo;",
                        next: "&raquo;"
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_mulai',
                        name: 'tanggal_mulai'
                    },
                    {
                        data: 'tanggal_selesai',
                        name: 'tanggal_selesai'
                    },
                    {
                        data: 'libur_akademik',
                        name: 'libur_akademik'
                    },
                    {
                        data: 'tahun_ajaran',
                        name: 'tahun_ajaran'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
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
