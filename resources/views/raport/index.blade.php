@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Raport Santri</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('raport.create') }}" class="btn btn-primary mb-4">
                        <i class="mdi mdi-plus"></i> Tambah Raport
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="raport-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Santri</th>
                                    <th>Guru</th>
                                    <th>Kelas</th>
                                    <th>Semester</th>
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
        const table = $('#raport-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('raport.index') }}',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍 Cari raport...",
                lengthMenu: "Tampilkan _MENU_ data",
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama_santri', name: 'nama_santri' },
                { data: 'nama_guru', name: 'nama_guru' },
                { data: 'nama_kelas', name: 'nama_kelas' },
                { data: 'semester', name: 'semester' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $('#searchBtn').on('click', function() {
            table.search($('#customSearch').val()).draw();
        });

        $('#customSearch').on('keypress', function(e) {
            if (e.which === 13) {
                table.search($(this).val()).draw();
            }
        });
    });
</script>
@endpush
