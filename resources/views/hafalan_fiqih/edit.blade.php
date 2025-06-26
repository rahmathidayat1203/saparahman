@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Hafalan Fiqih</h4>

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

                <form action="{{ route('hafalan-fiqih.update', $hafalanFiqih->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="id_santri" class="form-label">Santri</label>
                        <select id="id_santri" name="id_santri" class="form-control" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach ($santriList as $santri)
                                <option value="{{ $santri->id }}" {{ $hafalanFiqih->id_santri == $santri->id ? 'selected' : '' }}>
                                    {{ $santri->nama_santri }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_fiqih" class="form-label">Jenis Fiqih</label>
                        <select id="id_fiqih" name="id_fiqih" class="form-control" required>
                            <option value="">-- Pilih Jenis Fiqih --</option>
                            @foreach ($fiqihList as $fiqih)
                                <option value="{{ $fiqih->id }}" {{ $hafalanFiqih->id_fiqih == $fiqih->id ? 'selected' : '' }}>
                                    {{ $fiqih->jenis_fiqih }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tgl_setoran" class="form-label">Tanggal Setoran</label>
                        <input id="tgl_setoran" type="date" name="tgl_setoran" class="form-control" value="{{ $hafalanFiqih->tgl_setoran }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai" class="form-label">Nilai</label>
                        <select id="nilai" name="nilai" class="form-control" required>
                            <option value="">-- Pilih Nilai --</option>
                            @foreach($nilaiOptions as $nilai)
                                <option value="{{ $nilai }}" {{ $hafalanFiqih->nilai == $nilai ? 'selected' : '' }}>
                                    {{ $nilai }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('hafalan-fiqih.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
