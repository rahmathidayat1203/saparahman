@extends('layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Role</h4>

                <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm mb-3">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> Ada kesalahan dalam inputan Anda:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="name"><strong>Nama Role</strong></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $role->name) }}" placeholder="Nama Role">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label><strong>Permission</strong></label>
                        
                        {{-- Select All/None Controls --}}
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-primary btn-sm" id="select-all">
                                <i class="mdi mdi-check-all"></i> Pilih Semua
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm ml-2" id="deselect-all">
                                <i class="mdi mdi-close-box-multiple"></i> Hapus Semua
                            </button>
                        </div>
                        
                        {{-- Group permissions by module --}}
                        @php
                            $groupedPermissions = [];
                            foreach($permission as $perm) {
                                // Extract module name from permission name
                                // Assumes format like "users-list", "users-create", "posts-edit", etc.
                                $parts = explode('-', $perm->name);
                                $module = count($parts) > 1 ? ucfirst($parts[0]) : 'General';
                                $groupedPermissions[$module][] = $perm;
                            }
                            ksort($groupedPermissions);
                        @endphp
                        
                        <div class="row">
                            @foreach($groupedPermissions as $module => $permissions)
                                <div class="col-md-6 mb-4">
                                    <div class="card border">
                                        <div class="card-header bg-light py-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0 font-weight-bold">{{ $module }}</h6>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input module-checkbox" data-module="{{ strtolower($module) }}" id="module-{{ strtolower($module) }}">
                                                    <label class="form-check-label small" for="module-{{ strtolower($module) }}">
                                                        Pilih Semua
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body py-2">
                                            @foreach($permissions as $perm)
                                                <div class="form-check mb-1">
                                                    <input type="checkbox" 
                                                           name="permission[{{ $perm->id }}]" 
                                                           value="{{ $perm->id }}" 
                                                           class="form-check-input permission-checkbox" 
                                                           data-module="{{ strtolower($module) }}"
                                                           id="perm-{{ $perm->id }}"
                                                           {{ in_array($perm->id, $rolePermissions) ? 'checked' : '' }}>
                                                    <label class="form-check-label small" for="perm-{{ $perm->id }}">
                                                        {{ ucwords(str_replace('-', ' ', $perm->name)) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize module checkboxes based on current permissions
    document.querySelectorAll('.module-checkbox').forEach(moduleCheckbox => {
        const module = moduleCheckbox.dataset.module;
        const modulePermissions = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
        const checkedPermissions = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]:checked`);
        
        if (checkedPermissions.length === modulePermissions.length) {
            moduleCheckbox.checked = true;
            moduleCheckbox.indeterminate = false;
        } else if (checkedPermissions.length > 0) {
            moduleCheckbox.checked = false;
            moduleCheckbox.indeterminate = true;
        } else {
            moduleCheckbox.checked = false;
            moduleCheckbox.indeterminate = false;
        }
    });
    
    // Select All functionality
    document.getElementById('select-all').addEventListener('click', function() {
        document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
            checkbox.checked = true;
        });
        document.querySelectorAll('.module-checkbox').forEach(checkbox => {
            checkbox.checked = true;
            checkbox.indeterminate = false;
        });
    });
    
    // Deselect All functionality
    document.getElementById('deselect-all').addEventListener('click', function() {
        document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
        document.querySelectorAll('.module-checkbox').forEach(checkbox => {
            checkbox.checked = false;
            checkbox.indeterminate = false;
        });
    });
    
    // Module checkbox functionality
    document.querySelectorAll('.module-checkbox').forEach(moduleCheckbox => {
        moduleCheckbox.addEventListener('change', function() {
            const module = this.dataset.module;
            const isChecked = this.checked;
            
            document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`).forEach(permCheckbox => {
                permCheckbox.checked = isChecked;
            });
            
            this.indeterminate = false;
        });
    });
    
    // Individual permission checkbox functionality
    document.querySelectorAll('.permission-checkbox').forEach(permCheckbox => {
        permCheckbox.addEventListener('change', function() {
            const module = this.dataset.module;
            const moduleCheckboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
            const checkedCount = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]:checked`).length;
            const moduleCheckbox = document.querySelector(`.module-checkbox[data-module="${module}"]`);
            
            if (checkedCount === moduleCheckboxes.length) {
                moduleCheckbox.checked = true;
                moduleCheckbox.indeterminate = false;
            } else if (checkedCount > 0) {
                moduleCheckbox.checked = false;
                moduleCheckbox.indeterminate = true;
            } else {
                moduleCheckbox.checked = false;
                moduleCheckbox.indeterminate = false;
            }
        });
    });
});
</script>

<style>
.card-header {
    border-bottom: 1px solid #dee2e6;
}

.form-check-label.small {
    font-size: 0.875rem;
}

.card.border {
    border: 1px solid #dee2e6 !important;
}

.module-checkbox:indeterminate {
    opacity: 0.5;
}
</style>
@endsection