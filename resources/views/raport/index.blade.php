@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Detail Nilai Raport</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('detail-nilai-raport.create') }}" class="btn btn-primary mb-3">
                        <i class="mdi mdi-plus"></i> Tambah Detail Nilai
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="detail-nilai-raport-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Santri (Raport)</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Nilai</th>
                                    <th>Deskripsi</th>
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
        const table = $('#detail-nilai-raport-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('detail-nilai-raport.index') }}',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍 Cari detail nilai...",
                lengthMenu: "Tampilkan _MENU_ data",
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'raport_santri', name: 'raport_santri' },
                { data: 'mapel', name: 'mapel' },
                { data: 'nilai', name: 'nilai' },
                { data: 'desk', name: 'desk' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // (Optional) Custom search box
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
