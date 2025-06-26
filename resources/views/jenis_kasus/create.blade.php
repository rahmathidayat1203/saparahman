@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Jenis Kasus</h4>
                    <p class="card-description">Formulir untuk menambahkan jenis kasus baru</p>

                    <form class="forms-sample" action="{{ route('jenis_kasus.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="jenis_kasus">Jenis Kasus</label>
                            <input type="text"
                                   class="form-control @error('jenis_kasus') is-invalid @enderror"
                                   id="jenis_kasus"
                                   name="jenis_kasus"
                                   placeholder="Masukkan jenis kasus"
                                   value="{{ old('jenis_kasus') }}"
                                   required>
                            @error('jenis_kasus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Simpan
                        </button>
                        <a href="{{ route('jenis_kasus.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
