@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Ekskul</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="mb-3">
                    <a href="{{ route('master_ekskul.create') }}" class="btn btn-success">
                        <i class="mdi mdi-plus"></i> Tambah Ekskul
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped" id="eksulTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ekskul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTable will populate dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#eksulTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('master_ekskul.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama_ekskul', name: 'nama_ekskul' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
