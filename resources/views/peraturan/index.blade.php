@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Peraturan</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('peraturan.create') }}" class="btn btn-primary mb-3">
                        <i class="mdi mdi-plus"></i> Tambah Peraturan
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="peraturan-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peraturan</th>
                                    <th>Jenis Peraturan</th>
                                    <th>File</th>
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
            const table = $('#peraturan-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('peraturan.index') }}',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "🔍 Cari peraturan...",
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
                        data: 'nama_peraturan',
                        name: 'nama_peraturan'
                    },
                    {
                        data: 'jenis_peraturan',
                        name: 'jenis_peraturan'
                    },
                    {
                        data: 'file',
                        name: 'file',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Custom search trigger
            $('#searchBtn').on('click', function() {
                table.search($('#customSearch').val()).draw();
            });

            // Optional: search on Enter key
            $('#customSearch').on('keypress', function(e) {
                if (e.which === 13) {
                    table.search($(this).val()).draw();
                }
            });
        });
    </script>
@endpush
