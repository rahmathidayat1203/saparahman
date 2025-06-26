@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Mapel Kelas</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <a href="{{ route('mapel_kelas.create') }}" class="btn btn-success mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Mapel Kelas
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="mapel-kelas-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kelas</th>
                                <th>Nama Mapel</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTable akan populate via Ajax -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#mapel-kelas-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('mapel_kelas.index') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nama_kelas', name: 'nama_kelas' },
                { data: 'id_master_mapel', name: 'id_master_mapel' },
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
