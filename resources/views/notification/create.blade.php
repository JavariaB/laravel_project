@extends('layouts.app')

@section('title', (isset($notification->id) ? 'Update' : 'Add') . ' Notification')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{{ isset($notification->id) ? 'Update' : 'Add' }} Notification</h3>
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
                                    <form action="{{ isset($notification->id) && !empty($notification->id) ? route('notifications.update', $notification->id) : route('notifications.store') }}" method="post">
                                        @csrf()    

                                        @if (isset($notification->id))
                                        <input type="hidden" name="_method" value="put">
                                        @endif

                                        <div class="form-group">
                                            <label for="name" class="control-label">Name <span class="text-danger">*<span></label>
                                            @php 
                                                $notificationName = '';
                                                if (isset($notification->name)) $notificationName = $notification->name; 
                                                if (old('name')) $notificationName = old('name'); 
                                            @endphp
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter notification name" value="{{ $notificationName }}">
                                        </div>
                                        <div class="form-group">
                                            @php 
                                                $notificationDescription = '';
                                                if (isset($notification->description)) $notificationDescription = $notification->description; 
                                                if (old('description')) $notificationDescription = old('description'); 
                                            @endphp
                                            <label for="description" class="control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Enter notification description">{{ $notificationDescription }}</textarea>
                                        </div>

                                        <div class="form-group text-right mt-4">
                                            <a href="{{ route('notifications.index') }}" class="btn btn-light">Cancel</a>
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