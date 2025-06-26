@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Santri</h4>

                    <!-- Tampilkan pesan error jika ada -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> Ada kesalahan pada input.<br><br>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('santri.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="nama_santri">Nama Santri</label>
                            <input type="text" class="form-control" name="nama_santri" value="{{ old('nama_santri') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" name="nisn" value="{{ old('nisn') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" name="nis" value="{{ old('nis') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="nsm">NSM</label>
                            <input type="text" class="form-control" name="nsm" value="{{ old('nsm') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="npsm">NPSM</label>
                            <input type="text" class="form-control" name="npsm" value="{{ old('npsm') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_kelas">Kelas</label>
                            <select class="form-select rounded-pill py-2 px-3" name="id_kelas" id="id_kelas">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ old('id_kelas') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }} - {{ $k->tingkatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gender">Gender</label>
                            <select class="form-select rounded-pill py-2 px-3" name="gender" id="gender">
                                <option value="">-- Pilih Gender --</option>
                                <option value="santriwan" {{ old('gender') == 'santriwan' ? 'selected' : '' }}>Santriwan
                                </option>
                                <option value="santriwati" {{ old('gender') == 'santriwati' ? 'selected' : '' }}>Santriwati
                                </option>
                            </select>
                        </div>


                        <button type="submit" class="btn btn-success me-2">
                            <i class="mdi mdi-content-save"></i> Simpan
                        </button>
                        <a href="{{ route('santri.index') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
