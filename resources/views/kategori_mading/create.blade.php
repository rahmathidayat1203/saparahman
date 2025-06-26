@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Tambah Kategori Mading</h4>

                {{-- Menampilkan pesan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada kesalahan dalam input:
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('kategori-mading.store') }}" method="POST" class="forms-sample">
                    @csrf

                    <div class="form-group">
                        <label for="kategori">Nama Kategori</label>
                        <input type="text"
                               class="form-control"
                               id="kategori"
                               name="kategori"
                               value="{{ old('kategori') }}"
                               required
                               placeholder="Masukkan nama kategori">
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <a href="{{ route('kategori-mading.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
