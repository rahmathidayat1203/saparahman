@extends('layouts.admin.index')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Jenis Kasus</h4>
                    <p class="card-description">Informasi lengkap tentang jenis kasus</p>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Kasus:</label>
                        <div class="border rounded p-2 bg-light">
                            {{ $jenisKasus->jenis_kasus }}
                        </div>
                    </div>

                    <a href="{{ route('jenis_kasus.index') }}" class="btn btn-light">
                        <i class="ti-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
