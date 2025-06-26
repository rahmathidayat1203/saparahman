@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Detail Ekskul Raport</h4>
                    <p class="card-description">Formulir untuk mengubah data ekskul dalam raport santri</p>

                    <form class="forms-sample" action="{{ route('detail_ekskul_raport.update', $detail_ekskul_raport->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="id_raport">Raport</label>
                            <select name="id_raport" class="form-control @error('id_raport') is-invalid @enderror" required>
                                <option value="">-- Pilih Raport --</option>
                                @foreach ($raports as $raport)
                                    <option value="{{ $raport->id }}"
                                        {{ $detail_ekskul_raport->id_raport == $raport->id ? 'selected' : '' }}>
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
                                    <option value="{{ $ekskul->id }}"
                                        {{ $detail_ekskul_raport->id_ekskul == $ekskul->id ? 'selected' : '' }}>
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
                            <select name="nilai" class="form-control @error('nilai') is-invalid @enderror" required>
                                <option value="">-- Pilih Nilai --</option>
                                <option value="A" {{ $detail_ekskul_raport->nilai == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $detail_ekskul_raport->nilai == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ $detail_ekskul_raport->nilai == 'C' ? 'selected' : '' }}>C</option>
                            </select>
                            @error('nilai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-check-box"></i> Update
                        </button>
                        <a href="{{ route('detail_ekskul_raport.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
