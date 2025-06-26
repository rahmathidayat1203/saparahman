@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Kasus</h4>
                    <p class="card-description">Formulir untuk menambahkan data kasus pelanggaran</p>

                    <form class="forms-sample" action="{{ route('kasus.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="jenis_pelanggaran">Jenis Pelanggaran</label>
                            <input type="text" class="form-control @error('jenis_pelanggaran') is-invalid @enderror"
                                name="jenis_pelanggaran" value="{{ old('jenis_pelanggaran') }}" required>
                            @error('jenis_pelanggaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tgl_kejadian">Tanggal Kejadian</label>
                            <input type="date" class="form-control @error('tgl_kejadian') is-invalid @enderror"
                                name="tgl_kejadian" value="{{ old('tgl_kejadian') }}" required>
                            @error('tgl_kejadian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ket_pelanggaran">Keterangan Pelanggaran</label>
                            <textarea class="form-control @error('ket_pelanggaran') is-invalid @enderror"
                                name="ket_pelanggaran" rows="3" required>{{ old('ket_pelanggaran') }}</textarea>
                            @error('ket_pelanggaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="desc_penyelesaian">Deskripsi Penyelesaian</label>
                            <textarea class="form-control @error('desc_penyelesaian') is-invalid @enderror"
                                name="desc_penyelesaian" rows="3" required>{{ old('desc_penyelesaian') }}</textarea>
                            @error('desc_penyelesaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_jenis_kasus">Jenis Kasus</label>
                            <select class="form-control @error('id_jenis_kasus') is-invalid @enderror"
                                name="id_jenis_kasus" required>
                                <option value="">-- Pilih Jenis Kasus --</option>
                                @foreach ($jenisKasus as $jenis)
                                    <option value="{{ $jenis->id }}"
                                        {{ old('id_jenis_kasus') == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->jenis_kasus }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis_kasus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_santri">Santri</label>
                            <select class="form-control @error('id_santri') is-invalid @enderror"
                                name="id_santri" required>
                                <option value="">-- Pilih Santri --</option>
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}"
                                        {{ old('id_santri') == $santri->id ? 'selected' : '' }}>
                                        {{ $santri->nama_santri }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_santri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Simpan
                        </button>
                        <a href="{{ route('kasus.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
