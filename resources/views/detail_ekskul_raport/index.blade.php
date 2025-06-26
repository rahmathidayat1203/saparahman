@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Detail Ekskul Raport</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('detail_ekskul_raport.create') }}" class="btn btn-primary mb-3">
                        <i class="mdi mdi-plus"></i> Tambah Data
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="raport-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Santri</th>
                                    <th>Nama Ekskul</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Data akan diisi oleh DataTables --}}
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
                $('#raport-table').DataTable({
                    processing: true,
                    serverSide: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "🔍 Cari data ekskul...",
                        lengthMenu: "Tampilkan _MENU_ data",
                        paginate: {
                            previous: "&laquo;",
                            next: "&raquo;"
                        }
                    },
                    ajax: "{{ route('detail_ekskul_raport.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama_santri',
                            name: 'nama_santri'
                        },
                        {
                            data: 'nama_ekskul',
                            name: 'nama_ekskul'
                        },
                        {
                            data: 'nilai',
                            name: 'nilai'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
