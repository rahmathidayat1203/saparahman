@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Jenis Kasus</h4>
                    <p class="card-description">Formulir untuk mengubah data jenis kasus</p>

                    <form class="forms-sample" action="{{ route('jenis_kasus.update', $jenisKasus->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="jenis_kasus">Jenis Kasus</label>
                            <input type="text"
                                   class="form-control @error('jenis_kasus') is-invalid @enderror"
                                   id="jenis_kasus"
                                   name="jenis_kasus"
                                   placeholder="Masukkan jenis kasus"
                                   value="{{ old('jenis_kasus', $jenisKasus->jenis_kasus) }}"
                                   required>
                            @error('jenis_kasus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-check-box"></i> Update
                        </button>
                        <a href="{{ route('jenis_kasus.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
