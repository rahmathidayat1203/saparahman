@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Kasus</h4>
                    <p class="card-description">Formulir untuk mengubah data kasus pelanggaran</p>

                    <form action="{{ route('kasus.update', $kasus->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="id_santri">Santri</label>
                            <select name="id_santri" class="form-control @error('id_santri') is-invalid @enderror" required>
                                <option value="">-- Pilih Santri --</option>
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}"
                                        {{ old('id_santri', $kasus->id_santri) == $santri->id ? 'selected' : '' }}>
                                        {{ $santri->nama_santri }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_santri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_jenis_kasus">Jenis Pelanggaran</label>
                            <select name="id_jenis_kasus" class="form-control @error('id_jenis_kasus') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Pelanggaran --</option>
                                @foreach ($jenisKasus as $jenis)
                                    <option value="{{ $jenis->id }}"
                                        {{ old('id_jenis_kasus', $kasus->id_jenis_kasus) == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->jenis_kasus }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis_kasus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tgl_kejadian">Tanggal Kejadian</label>
                            <input type="date" name="tgl_kejadian" class="form-control @error('tgl_kejadian') is-invalid @enderror"
                                value="{{ old('tgl_kejadian', $kasus->tgl_kejadian) }}" required>
                            @error('tgl_kejadian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ket_pelanggaran">Keterangan Pelanggaran</label>
                            <textarea name="ket_pelanggaran" rows="3"
                                class="form-control @error('ket_pelanggaran') is-invalid @enderror"
                                required>{{ old('ket_pelanggaran', $kasus->ket_pelanggaran) }}</textarea>
                            @error('ket_pelanggaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="desc_penyelesaian">Deskripsi Penyelesaian</label>
                            <textarea name="desc_penyelesaian" rows="3"
                                class="form-control @error('desc_penyelesaian') is-invalid @enderror">{{ old('desc_penyelesaian', $kasus->desc_penyelesaian) }}</textarea>
                            @error('desc_penyelesaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Update
                        </button>
                        <a href="{{ route('kasus.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
