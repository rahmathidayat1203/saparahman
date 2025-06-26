@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Hafalan Inggris</h4>

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

                <form action="{{ route('hafalan-inggris.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="id_santri" class="form-label">Santri</label>
                        <select id="id_santri" name="id_santri" class="form-control" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach ($santriList as $santri)
                                <option value="{{ $santri->id }}" {{ old('id_santri') == $santri->id ? 'selected' : '' }}>
                                    {{ $santri->nama_santri }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_inggris" class="form-label">Subjek Inggris</label>
                        <select id="id_inggris" name="id_inggris" class="form-control" required>
                            <option value="">-- Pilih Subjek --</option>
                            @foreach ($inggrisList as $inggris)
                                <option value="{{ $inggris->id }}" {{ old('id_inggris') == $inggris->id ? 'selected' : '' }}>
                                    {{ $inggris->subjek }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tgl_setoran" class="form-label">Tanggal Setoran</label>
                        <input id="tgl_setoran" type="date" name="tgl_setoran" class="form-control" value="{{ old('tgl_setoran') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai" class="form-label">Nilai</label>
                        <select id="nilai" name="nilai" class="form-control" required>
                            <option value="">-- Pilih Nilai --</option>
                            @foreach ($nilaiOptions as $nilai)
                                <option value="{{ $nilai }}" {{ old('nilai') == $nilai ? 'selected' : '' }}>
                                    {{ $nilai }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('hafalan-inggris.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
