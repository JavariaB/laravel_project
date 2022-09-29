@extends('layouts.app')

@section('title', (isset($user->id) ? 'Update' : 'Add') . ' User')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{{ isset($user->id) ? 'Update' : 'Add' }} User</h3>
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
                                    <form action="{{ isset($user->id) && !empty($user->id) ? route('users.update', $user->id) : route('users.store') }}" method="post">
                                        @csrf()    

                                        @if (isset($user->id))
                                        <input type="hidden" name="_method" value="put">
                                        @endif

                                        <div class="form-group">
                                            <label for="role" class="control-label">Role <span class="text-danger">*<span></label>
                                            @php 
                                                $roleId = '';
                                                if (isset($product->role_id)) $roleId = $product->role_id; 
                                                if (old('role')) $roleId = old('role');
                                            @endphp
                                            <select name="role" id="role" class="form-control">
                                                <option value="" selected disabled>-- Choose a role --</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $roleId == $role->id ? 'selected' : '' }}>
                                                        {{ ucwords($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label">Name <span class="text-danger">*<span></label>
                                            @php 
                                                $userName = '';
                                                if (isset($user->name)) $userName = $user->name; 
                                                if (old('name')) $userName = old('name'); 
                                            @endphp
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter user name" value="{{ $userName }}">
                                        </div>
                                        <div class="form-group">
                                            @php 
                                                $userEmail = '';
                                                if (isset($user->email)) $userEmail = $user->email; 
                                                if (old('email')) $userEmail = old('email'); 
                                            @endphp
                                            <label for="email" class="control-label">Email</label>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter user email" value="{{ $userEmail }}">
                                        </div>

                                        <div class="form-group text-right mt-4">
                                            <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
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