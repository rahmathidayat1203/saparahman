@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Jenis Kasus</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('jenis_kasus.create') }}" class="btn btn-primary mb-3">
                        <i class="mdi mdi-plus"></i> Tambah Jenis Kasus
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="jenis-kasus-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Kasus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- DataTables akan mengisi data di sini --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#jenis-kasus-table').DataTable({
                    processing: true,
                    serverSide: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "🔍 Cari jenis kasus...",
                        lengthMenu: "Tampilkan _MENU_ data",
                        paginate: {
                            previous: "&laquo;",
                            next: "&raquo;"
                        }
                    },
                    ajax: '{{ route('jenis_kasus.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'jenis_kasus', name: 'jenis_kasus' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
@endsection
