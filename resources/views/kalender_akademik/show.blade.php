@extends('layouts.admin.index'))

@section('content')
<div class="container">
    <h2>Detail Kalender Akademik</h2>
    <table class="table table-bordered">
        <tr>
            <th>Tanggal Mulai</th><td>{{ $kalenderAkademik->tanggal_mulai }}</td>
        </tr>
        <tr>
            <th>Tanggal Selesai</th><td>{{ $kalenderAkademik->tanggal_selesai }}</td>
        </tr>
        <tr>
            <th>Libur Akademik</th><td>{{ $kalenderAkademik->libur_akademik }}</td>
        </tr>
        <tr>
            <th>Tahun Ajaran</th><td>{{ $kalenderAkademik->tahun_ajaran }}</td>
        </tr>
        <tr>
            <th>Keterangan</th><td>{{ $kalenderAkademik->keterangan }}</td>
        </tr>
    </table>
    <a href="{{ route('kalender_akademik.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
