@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Subjek Bahasa Inggris</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('inggris.create') }}" class="btn btn-primary mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Subjek
                </a>

                <div class="table-responsive">
                    <table class="table table-striped" id="inggris-table">
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
        $('#inggris-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('inggris.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'subjek', name: 'subjek' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "🔍 Cari subjek...",
                lengthMenu: "Tampilkan _MENU_ data",
                paginate: {
                    previous: "&laquo;",
                    next: "&raquo;"
                }
            }
        });
    });
</script>
@endpush
