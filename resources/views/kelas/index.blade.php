@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Kelas</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <a href="{{ route('kelas.create') }}" class="btn btn-success mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Kelas
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="kelas-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tingkatan</th>
                                <th>Nama Kelas</th>
                                <th>Tingkat Kelas</th>
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
        $('#kelas-table').DataTable({
            processing: true,
            serverSide: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍 Cari kelas...",
                lengthMenu: "Tampilkan _MENU_ data",
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                }
            },
            ajax: '{{ route('kelas.index') }}',
            columns: [
                { data: 'id', name: 'id', orderable: false, searchable: false },
                { data: 'tingkatan', name: 'tingkatan' },
                { data: 'nama_kelas', name: 'nama_kelas' },
                { data: 'tingkat_kelas', name: 'tingkat_kelas' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
