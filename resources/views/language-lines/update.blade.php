@extends('layouts.app')

@section('title', 'Update Language Line')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Update Language Line</h3>
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
                                    <form action="{{ route('language-lines.update', $languageLine->id) }}" method="post">
                                        @csrf()    

                                        <input type="hidden" name="_method" value="put">

                                        <div class="form-group">
                                            <label for="name" class="control-label">Name <span class="text-danger">*<span></label>
                                            @php 
                                                $languageLineName = '';
                                                if (isset($languageLine->name)) $languageLineName = $languageLine->name; 
                                                if (old('name')) $languageLineName = old('name'); 
                                            @endphp
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter translation name" value="{{ $languageLineName }}">
                                        </div>
                                        <div class="form-group">
                                            @php 
                                                $languageLineDescription = '';
                                                if (isset($languageLine->description)) $languageLineDescription = $languageLine->description; 
                                                if (old('description')) $languageLineDescription = old('description'); 
                                            @endphp
                                            <label for="description" class="control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Enter translation description">{{ $languageLineDescription }}</textarea>
                                        </div>

                                        <div class="form-group text-right mt-4">
                                            <a href="{{ route('language-lines.index') }}" class="btn btn-light">Cancel</a>
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