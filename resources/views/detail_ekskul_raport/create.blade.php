@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Detail Ekskul Raport</h4>
                    <p class="card-description">Formulir untuk menambahkan data ekskul pada raport santri</p>

                    <form class="forms-sample" action="{{ route('detail_ekskul_raport.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="id_raport">Raport</label>
                            <select name="id_raport" class="form-control @error('id_raport') is-invalid @enderror" required>
                                <option value="">-- Pilih Raport --</option>
                                @foreach ($raports as $raport)
                                    <option value="{{ $raport->id }}" {{ old('id_raport') == $raport->id ? 'selected' : '' }}>
                                        Semester {{ $raport->semester }} - {{ $raport->santri->nama_santri ?? 'Santri #' . $raport->id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_raport')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_ekskul">Ekstrakurikuler</label>
                            <select name="id_ekskul" class="form-control @error('id_ekskul') is-invalid @enderror" required>
                                <option value="">-- Pilih Ekskul --</option>
                                @foreach ($ekskuls as $ekskul)
                                    <option value="{{ $ekskul->id }}" {{ old('id_ekskul') == $ekskul->id ? 'selected' : '' }}>
                                        {{ $ekskul->nama_ekskul }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_ekskul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <select name="nilai" id="nilai" class="form-control @error('nilai') is-invalid @enderror" required>
                                <option value="">-- Pilih Nilai --</option>
                                <option value="A" {{ old('nilai') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('nilai') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ old('nilai') == 'C' ? 'selected' : '' }}>C</option>
                            </select>
                            @error('nilai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Simpan
                        </button>
                        <a href="{{ route('detail_ekskul_raport.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
