@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Guru</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('guru.create') }}" class="btn btn-primary mb-3">
                        <i class="mdi mdi-plus"></i> Tambah Guru
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="guru-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Kelas</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                $('#guru-table').DataTable({
                    processing: true,
                    serverSide: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "🔍 Cari guru...",
                        lengthMenu: "Tampilkan _MENU_ data",
                        paginate: {
                            previous: "&laquo;",
                            next: "&raquo;"
                        }
                    },
                    ajax: '{{ route('guru.index') }}',
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama_guru',
                            name: 'nama_guru'
                        },
                        {
                            data: 'username',
                            name: 'username'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'kelas_name',
                            name: 'kelas_name'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
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
            });
        </script>
    @endpush
@endsection
