@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Hafalan Inggris</h4>

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

                <form action="{{ route('hafalan-inggris.update', $hafalanInggris->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="id_santri" class="form-label">Santri</label>
                        <select name="id_santri" id="id_santri" class="form-control" required>
                            @foreach($santriList as $santri)
                                <option value="{{ $santri->id }}" {{ $hafalanInggris->id_santri == $santri->id ? 'selected' : '' }}>
                                    {{ $santri->nama_santri }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_inggris" class="form-label">Subjek Inggris</label>
                        <select name="id_inggris" id="id_inggris" class="form-control" required>
                            @foreach($inggrisList as $inggris)
                                <option value="{{ $inggris->id }}" {{ $hafalanInggris->id_inggris == $inggris->id ? 'selected' : '' }}>
                                    {{ $inggris->subjek }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tgl_setoran" class="form-label">Tanggal Setoran</label>
                        <input type="date" class="form-control" id="tgl_setoran" name="tgl_setoran" value="{{ $hafalanInggris->tgl_setoran }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai" class="form-label">Nilai</label>
                        <select name="nilai" id="nilai" class="form-control" required>
                            @foreach($nilaiOptions as $nilai)
                                <option value="{{ $nilai }}" {{ $hafalanInggris->nilai == $nilai ? 'selected' : '' }}>
                                    {{ $nilai }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('hafalan-inggris.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
