@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Hafalan Tahfidz</h4>

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

                <form action="{{ route('hafalan-tahfidz.update', $hafalanTahfidz->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_santri" class="form-label">Santri</label>
                        <select class="form-control" name="id_santri" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach ($santriList as $santri)
                                <option value="{{ $santri->id }}" {{ $hafalanTahfidz->id_santri == $santri->id ? 'selected' : '' }}>
                                    {{ $santri->nama_santri }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_tahfidz" class="form-label">Jenis Hafalan</label>
                        <select class="form-control" name="id_tahfidz" required>
                            <option value="">-- Pilih Jenis Hafalan --</option>
                            @foreach ($tahfidzList as $tahfidz)
                                <option value="{{ $tahfidz->id }}" {{ $hafalanTahfidz->id_tahfidz == $tahfidz->id ? 'selected' : '' }}>
                                    {{ $tahfidz->jenis_tahfidz }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tgl_setoran" class="form-label">Tanggal Setoran</label>
                        <input type="date" class="form-control" name="tgl_setoran" value="{{ $hafalanTahfidz->tgl_setoran }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <select name="nilai" class="form-control" required>
                            <option value="">-- Pilih Nilai --</option>
                            @foreach($nilaiOptions as $nilai)
                                <option value="{{ $nilai }}" {{ $hafalanTahfidz->nilai == $nilai ? 'selected' : '' }}>{{ $nilai }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('hafalan-tahfidz.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
