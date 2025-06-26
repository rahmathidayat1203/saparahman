@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Hafalan Surah</h4>

                <a href="{{ route('hafalan-surah.create') }}" class="btn btn-success btn-sm mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Hafalan
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="hafalanTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Santri</th>
                                <th>Surah</th>
                                <th>Tanggal Setoran</th>
                                <th>Nilai</th>
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
    $('#hafalanTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('hafalan-surah.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'santri', name: 'santri' },
            { data: 'surah', name: 'surah' },
            { data: 'tgl_setoran', name: 'tgl_setoran' },
            { data: 'nilai', name: 'nilai' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush
