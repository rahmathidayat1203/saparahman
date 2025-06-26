@extends('layouts.admin.index')

@section('content')
<div class="card">
    <div class="card-header">Detail Data Ekskul Raport</div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th>ID Raport</th>
                <td>{{ $detail_ekskul_raport->id_raport }}</td>
            </tr>
            <tr>
                <th>ID Ekskul</th>
                <td>{{ $detail_ekskul_raport->id_ekskul }}</td>
            </tr>
            <tr>
                <th>Nilai</th>
                <td>{{ $detail_ekskul_raport->nilai }}</td>
            </tr>
        </table>

        <a href="{{ route('detail_ekskul_raport.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection