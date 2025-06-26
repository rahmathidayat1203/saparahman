@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Detail Nilai Raport</h4>
                    <p class="card-description">
                        Formulir untuk menambah detail nilai raport baru
                    </p>

                    <form class="forms-sample" action="{{ route('detail-nilai-raport.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="id_raport">ID Raport</label>
                            <select 
                                name="id_raport" 
                                id="id_raport" 
                                class="form-control @error('id_raport') is-invalid @enderror" 
                                required
                            >
                                <option value="">-- Pilih Raport --</option>
                                @foreach ($raports as $raport)
                                    <option value="{{ $raport->id }}" {{ old('id_raport') == $raport->id ? 'selected' : '' }}>
                                        Semester {{ $raport->semester }} - {{ $raport->santri->nama_santri ?? 'Santri tidak ditemukan' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_raport')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_mapel">ID Mata Pelajaran</label>
                            <select 
                                name="id_mapel" 
                                id="id_mapel" 
                                class="form-control @error('id_mapel') is-invalid @enderror" 
                                required
                            >
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach ($mapels as $mapel)
                                    <option value="{{ $mapel->id }}" {{ old('id_mapel') == $mapel->id ? 'selected' : '' }}>
                                        {{ $mapel->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_mapel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input 
                                type="text" 
                                id="nilai" 
                                name="nilai" 
                                class="form-control @error('nilai') is-invalid @enderror" 
                                value="{{ old('nilai') }}" 
                                required
                            >
                            @error('nilai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="desk">Deskripsi</label>
                            <textarea 
                                id="desk" 
                                name="desk" 
                                rows="3" 
                                class="form-control @error('desk') is-invalid @enderror" 
                                required
                            >{{ old('desk') }}</textarea>
                            @error('desk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Simpan
                        </button>
                        <a href="{{ route('detail-nilai-raport.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
