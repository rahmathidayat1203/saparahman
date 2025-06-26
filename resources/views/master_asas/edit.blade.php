@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Master Asas</h4>

                {{-- Alert untuk error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada kesalahan dalam input data:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form edit --}}
                <form action="{{ route('master-asas.update', $masterAsas->id) }}" method="POST" class="forms-sample">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_asas">Nama Asas</label>
                        <input type="text"
                               class="form-control"
                               id="nama_asas"
                               name="nama_asas"
                               value="{{ old('nama_asas', $masterAsas->nama_asas) }}"
                               required
                               placeholder="Masukkan nama asas">
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a href="{{ route('master-asas.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
