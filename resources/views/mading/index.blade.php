@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Mading</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('mading.create') }}" class="btn btn-primary mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Mading
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="mading-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                {{-- <th>Asas</th> --}}
                                <th>Gambar</th>
                                <th>Gambaran</th>
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
        $('#mading-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('mading.index') }}',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍 Cari mading...",
                lengthMenu: "Tampilkan _MENU_ data",
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'judul', name: 'judul' },
                { data: 'id_kategori_mading', name: 'id_kategori_mading' },
                // { data: 'id_asas', name: 'id_asas' },
                { data: 'gambar', name: 'gambar' },
                { 
                    data: 'gambaran_deskripsi', 
                    name: 'gambaran_deskripsi',
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                            let shortText = data.length > 50 ? data.substring(0, 50) + '...' : data;
                            return '<div style="white-space: normal; word-wrap: break-word; max-width: 200px;">' + shortText + '</div>';
                        }
                        return data || '';
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            columnDefs: [
                {
                    targets: 5, // Kolom gambaran
                    width: '200px',
                    className: 'text-wrap'
                }
            ]
        });
    });

    function deleteData(id) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            $.ajax({
                url: '/mading/' + id,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#mading-table').DataTable().ajax.reload();
                    alert(response.success);
                }
            });
        }
    }
</script>

<style>
    #mading-table td:nth-child(6) {
        white-space: normal !important;
        word-wrap: break-word !important;
        max-width: 200px !important;
        vertical-align: top !important;
    }

    .description-tooltip {
        cursor: help;
        position: relative;
    }

    .description-tooltip:hover::after {
        content: attr(data-full-text);
        position: absolute;
        background: #333;
        color: white;
        padding: 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: normal;
        max-width: 300px;
        z-index: 1000;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
</style>
@endpush
