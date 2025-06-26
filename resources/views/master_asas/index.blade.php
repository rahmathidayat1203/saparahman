@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            {{-- Card Body --}}
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Daftar Master Asas</h4>
                    <a href="{{ route('master-asas.create') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus"></i> Tambah Master Asas
                    </a>
                </div>

                {{-- Alert --}}
                @if (session('success'))
                    <div class="alert alert-success py-2 px-3 mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="table-responsive pt-2">
                    <table class="table table-striped" id="master-asas-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Asas</th>
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
    $(function () {
        $('#master-asas-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('master-asas.index') }}',
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_asas',
                    name: 'nama_asas'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍 Cari asas...",
                lengthMenu: "Tampilkan _MENU_ data",
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                },
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)"
            },
            responsive: true
        });
    });
</script>
@endpush
