@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Hafalan Surah</h4>

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

                <form action="{{ route('hafalan-surah.update', $hafalanSurah->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="id_santri">Santri</label>
                        <select class="form-control" name="id_santri" required>
                            @foreach ($santriList as $santri)
                                <option value="{{ $santri->id }}" {{ $hafalanSurah->id_santri == $santri->id ? 'selected' : '' }}>
                                    {{ $santri->nama_santri }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_surah">Surah</label>
                        <select class="form-control" name="id_surah" required>
                            @foreach ($surahList as $surah)
                                <option value="{{ $surah->id }}" {{ $hafalanSurah->id_surah == $surah->id ? 'selected' : '' }}>
                                    {{ $surah->nama_surah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tgl_setoran">Tanggal Setoran</label>
                        <input type="date" class="form-control" name="tgl_setoran" value="{{ $hafalanSurah->tgl_setoran }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <select name="nilai" class="form-control" required>
                            @foreach($nilaiOptions as $nilai)
                                <option value="{{ $nilai }}" {{ $hafalanSurah->nilai == $nilai ? 'selected' : '' }}>{{ $nilai }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Update</button>
                    <a href="{{ route('hafalan-surah.index') }}" class="btn btn-light mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
