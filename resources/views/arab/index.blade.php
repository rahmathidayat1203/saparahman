@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Subjek Bahasa Arab</h4>

                <a href="{{ route('arab.create') }}" class="btn btn-primary mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Subjek
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="arab-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Subjek</th>
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
        $('#arab-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('arab.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'subjek', name: 'subjek' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
