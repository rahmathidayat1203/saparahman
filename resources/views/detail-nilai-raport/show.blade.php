@extends('layouts.admin.index')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Raport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Detail Raport</h1>

        <div class="mb-3">
            <label class="form-label">ID Santri:</label>
            <p>{{ $raport->id_santri }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">ID Guru:</label>
            <p>{{ $raport->id_guru }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">ID Kelas:</label>
            <p>{{ $raport->id_kelas }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Semester:</label>
            <p>{{ $raport->semester }}</p>
        </div>

        <a href="{{ route('raport.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
