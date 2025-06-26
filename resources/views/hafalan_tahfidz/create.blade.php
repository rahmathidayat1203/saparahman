@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Hafalan Tahfidz</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Ada kesalahan dalam input:<br><br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('hafalan-tahfidz.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="id_santri">Santri</label>
                        <select class="form-control" name="id_santri" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach ($santriList as $santri)
                                <option value="{{ $santri->id }}" {{ old('id_santri') == $santri->id ? 'selected' : '' }}>
                                    {{ $santri->nama_santri }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_tahfidz">Jenis Hafalan</label>
                        <select class="form-control" name="id_tahfidz" required>
                            <option value="">-- Pilih Jenis Hafalan --</option>
                            @foreach ($tahfidzList as $tahfidz)
                                <option value="{{ $tahfidz->id }}" {{ old('id_tahfidz') == $tahfidz->id ? 'selected' : '' }}>
                                    {{ $tahfidz->jenis_tahfidz }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tgl_setoran">Tanggal Setoran</label>
                        <input type="date" class="form-control" name="tgl_setoran" value="{{ old('tgl_setoran') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <select name="nilai" class="form-control" required>
                            <option value="">-- Pilih Nilai --</option>
                            @foreach($nilaiOptions as $nilai)
                                <option value="{{ $nilai }}" {{ old('nilai') == $nilai ? 'selected' : '' }}>{{ $nilai }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="{{ route('hafalan-tahfidz.index') }}" class="btn btn-light mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
