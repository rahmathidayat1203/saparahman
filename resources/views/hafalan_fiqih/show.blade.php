@extends('layouts.admin.index')

@section('content')
<div class="container">
    <h2>Detail Hafalan Fiqih</h2>

    <table class="table table-bordered">
        <tr>
            <th>Santri</th>
            <td>{{ $hafalanFiqih->santri->nama_santri }}</td>
        </tr>
        <tr>
            <th>Jenis Fiqih</th>
            <td>{{ $hafalanFiqih->fiqih->jenis_fiqih }}</td>
        </tr>
        <tr>
            <th>Tanggal Setoran</th>
            <td>{{ $hafalanFiqih->tgl_setoran }}</td>
        </tr>
        <tr>
            <th>Nilai</th>
            <td>{{ $hafalanFiqih->nilai }}</td>
        </tr>
    </table>

    <a href="{{ route('hafalan-fiqih.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
