@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Master Mapel</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('master_mapel.create') }}" class="btn btn-success mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Master Mapel
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="master-mapel-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Mapel</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTable akan mengisi data di sini melalui Ajax -->
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
        $('#master-mapel-table').DataTable({
            processing: true,
            serverSide: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍 Cari mapel...",
                lengthMenu: "Tampilkan _MENU_ data",
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                }
            },
            ajax: '{{ route('master_mapel.index') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nama_mapel', name: 'nama_mapel' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
