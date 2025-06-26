@extends('layouts.admin.index')

@section('content')
    <div class="container">
        <h2>Detail Raport P5</h2>

        <div class="mb-3">
            <strong>ID Raport:</strong> {{ $detail->id_raport }}
        </div>

        <div class="mb-3">
            <strong>Judul:</strong> {{ $detail->judul }}
        </div>

        <div class="mb-3">
            <strong>Foto:</strong><br>
            @if($detail->foto)
                <img src="{{ asset('storage/' . $detail->foto) }}" alt="Foto" width="200">
            @else
                <p>Tidak ada foto</p>
            @endif
        </div>

        <div class="mb-3">
            <strong>Deskripsi:</strong>
            <p>{{ $detail->desk }}</p>
        </div>

        <a href="{{ route('detail-raport-p5.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
