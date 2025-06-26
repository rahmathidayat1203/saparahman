@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Kandungan Mading</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('kandungan-mading.create') }}" class="btn btn-primary mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Kandungan Mading
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="kandungan-mading-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Asas</th>
                                <th>Pengampu</th>
                                <th>Judul</th>
                                <th>PDF</th>
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
        $('#kandungan-mading-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('kandungan-mading.index') }}',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍 Cari kandungan...",
                lengthMenu: "Tampilkan _MENU_ data",
                paginate: {
                    previous: "«",
                    next: "»"
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'id_asas', name: 'id_asas' },
                { data: 'nama_pengampu', name: 'nama_pengampu' },
                { data: 'judul', name: 'judul' },
                { data: 'pdf_file', name: 'pdf_file', orderable: false, searchable: false },
                { data: 'png_file', name: 'png_file', orderable: false, searchable: false },
                { 
                    data: 'desk', 
                    name: 'desk',
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                            let shortText = data.length > 50 ? data.substring(0, 50) + '...' : data;
                            return '<div class="description-tooltip" data-full-text="' + data + '" style="white-space: normal; word-wrap: break-word; max-width: 200px;">' + shortText + '</div>';
                        }
                        return data || '';
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            columnDefs: [
                {
                    targets: 6, // Index kolom Gambaran (dimulai dari 0)
                    width: '200px',
                    className: 'text-wrap'
                }
            ]
        });
    });
</script>

<style>
    #kandungan-mading-table td:nth-child(7) {
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