@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Detail Admin</h4>

                <div class="row mb-3">
                    <div class="col-sm-4 font-weight-bold">Nama</div>
                    <div class="col-sm-8">{{ $admin->nama_admin }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 font-weight-bold">Username</div>
                    <div class="col-sm-8">{{ $admin->username }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4 font-weight-bold">Email</div>
                    <div class="col-sm-8">{{ $admin->email }}</div>
                </div>

                @if ($admin->foto)
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Foto Profil</div>
                        <div class="col-sm-8">
                            <img src="{{ asset('storage/' . $admin->foto) }}" width="100" class="rounded" style="object-fit: cover;">
                        </div>
                    </div>
                @endif

                <a href="{{ route('admin.index') }}" class="btn btn-light mt-3">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>

            </div>
        </div>
    </div>
</div>
@endsection
