@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Detail Ekskul</h2>

    <div class="mb-3">
        <label class="form-label"><strong>Nama Ekskul:</strong></label>
        <div>{{ $master_ekskul->nama_ekskul }}</div>
    </div>

    <a href="{{ route('master_ekskul.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
