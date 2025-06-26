@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Detail Raport P5</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('detail-raport-p5.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Tambah Detail Raport P5
                        </a>

                        <div>
                            <select id="filter_id_raport" class="form-select" style="width: 200px;">
                                <option value="">Filter ID Raport</option>
                                @foreach ($raports as $raport)
                                    <option value="{{ $raport->id }}">{{ $raport->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped" id="detail-raport-p5-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Raport</th>
                                    <th>Judul</th>
                                    <th>Foto</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- DataTable Ajax --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function() {
                var table = $('#detail-raport-p5-table').DataTable({
                    processing: true,
                    serverSide: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "🔍 Cari detail raport...",
                        lengthMenu: "Tampilkan _MENU_ data",
                        paginate: {
                            previous: "&laquo;",
                            next: "&raquo;"
                        }
                    },
                    ajax: {
                        url: '{{ route('detail-raport-p5.index') }}',
                        data: function(d) {
                            d.id_raport = $('#filter_id_raport').val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'raport_santri',
                            name: 'raport.santri.nama_santri'
                        },
                        {
                            data: 'judul',
                            name: 'judul'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                        },

                        {
                            data: 'desk',
                            name: 'desk'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]

                });

                $('#filter_id_raport').change(function() {
                    table.draw();
                });
            });
        </script>
    @endpush
@endsection
