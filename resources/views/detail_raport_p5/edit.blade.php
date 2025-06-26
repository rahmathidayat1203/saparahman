@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Raport</h4>

                <form action="{{ route('raport.update', $raport->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_santri" class="form-label">Santri</label>
                        <select class="form-select" id="id_santri" name="id_santri" required>
                            <option value="">Pilih Santri</option>
                            @foreach ($santris as $santri)
                                <option value="{{ $santri->id }}" {{ $santri->id == $raport->id_santri ? 'selected' : '' }}>
                                    {{ $santri->nama_santri }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_santri')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_guru" class="form-label">Guru</label>
                        <select class="form-select" id="id_guru" name="id_guru" required>
                            <option value="">Pilih Guru</option>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id }}" {{ $guru->id == $raport->id_guru ? 'selected' : '' }}>
                                    {{ $guru->nama_guru }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_guru')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_kelas" class="form-label">Kelas</label>
                        <select class="form-select" id="id_kelas" name="id_kelas" required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}" {{ $kelasItem->id == $raport->id_kelas ? 'selected' : '' }}>
                                    {{ $kelasItem->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kelas')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-select" id="semester" name="semester" required>
                            <option value="1" {{ $raport->semester == '1' ? 'selected' : '' }}>Semester 1</option>
                            <option value="2" {{ $raport->semester == '2' ? 'selected' : '' }}>Semester 2</option>
                        </select>
                        @error('semester')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <a href="{{ route('raport.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
