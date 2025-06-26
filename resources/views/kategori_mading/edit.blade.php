@extends('layouts.admin.index')

@section('content')
<div class="page-header">
    <h3 class="page-title"> Edit Kategori Mading </h3>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Edit Kategori</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada kesalahan dalam input.<br><br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="forms-sample" action="{{ route('kategori-mading.update', $kategoriMading->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori"
                            value="{{ old('kategori', $kategoriMading->kategori) }}" placeholder="Masukkan nama kategori" required>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a href="{{ route('kategori-mading.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
