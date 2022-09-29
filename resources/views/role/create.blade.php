@extends('layouts.app')

@section('title', (isset($role->id) ? 'Update' : 'Add') . ' Role')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{{ isset($role->id) ? 'Update' : 'Add' }} Role</h3>
                        </div>
                    </div>
                </div>
                <div class="nk-block nk-block-lg">
                    <div class="row g-gs">
                        <div class="col-lg-12">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    @if($errors->any())
                                    <div class="alert alert-danger">
                                        <b>Error: </b> {{ $errors->first() }}
                                    </div>
                                    @endif
                                    <form action="{{ isset($role->id) && !empty($role->id) ? route('roles.update', $role->id) : route('roles.store') }}" method="post">
                                        @csrf()    

                                        @if (isset($role->id))
                                        <input type="hidden" name="_method" value="put">
                                        @endif

                                        <div class="form-group">
                                            <label for="name" class="control-label">Role Name <span class="text-danger">*<span></label>
                                            @php 
                                                $roleName = '';
                                                if (isset($role->name)) $roleName = $role->name; 
                                                if (old('name')) $roleName = old('name');
                                            @endphp
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter role name" value="{{ $roleName }}">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="mt-1 mb-4">Permissions</h4>
                                                <div class="row">
                                                    @php 
                                                        $rolePermissions = [];
                                                        if (isset($role_permissions)) $rolePermissions = $role_permissions; 
                                                        if (old('permissions')) $rolePermissions = old('permissions');
                                                    @endphp
                                                    @foreach ($permissions as $permission)
                                                    <div class="col-md-3">
                                                        <div class="custom-control custom-checkbox pb-2">
                                                            <input type="checkbox" name="permissions[]" class="custom-control-input" value="{{ $permission->id }}" id="{{ $permission->id }}" 
                                                                {!! isset($rolePermissions) && in_array($permission->id, $rolePermissions) ? 'checked' : '' !!}>
                                                            <label class="custom-control-label" for="{{ $permission->id }}">{{ $permission->name }}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-right mt-4">
                                            <a href="{{ route('roles.index') }}" class="btn btn-light">Cancel</a>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection