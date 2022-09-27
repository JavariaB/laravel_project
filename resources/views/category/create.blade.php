@extends('layouts.app')

@section('title', (isset($category->id) ? 'Update' : 'Add') . ' Category')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{{ isset($category->id) ? 'Update' : 'Add' }} Category</h3>
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
                                    <form action="{{ isset($category->id) && !empty($category->id) ? route('categories.update', $category->id) : route('categories.store') }}" method="post">
                                        @csrf()    

                                        @if (isset($category->id))
                                        <input type="hidden" name="_method" value="put">
                                        @endif

                                        <div class="form-group">
                                            <label for="name_en" class="control-label">Name (English) <span class="text-danger">*<span></label>
                                            @php 
                                                $categoryName_en = '';
                                                if (isset($category->name_en)) $categoryName_en = $category->name_en; 
                                                if (old('name_en')) $categoryName_en = old('name_en'); 
                                            @endphp
                                            <input type="text" name="name_en" id="name_en" class="form-control" placeholder="Enter category name in english" value="{{ $categoryName_en }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="name_ar" class="control-label">Name (Arabic) <span class="text-danger">*<span></label>
                                            @php 
                                                $categoryName_ar = '';
                                                if (isset($category->name_ar)) $categoryName_ar = $category->name_ar; 
                                                if (old('name_ar')) $categoryName_ar = old('name_ar'); 
                                            @endphp
                                            <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="Enter category name in arabic" value="{{ $categoryName_ar }}">
                                        </div>
                                        <div class="form-group">
                                            @php 
                                                $categoryDescription_en = '';
                                                if (isset($category->description_en)) $categoryDescription_en = $category->description_en; 
                                                if (old('description_en')) $categoryDescription_en = old('description_en'); 
                                            @endphp
                                            <label for="description_en" class="control-label">Description (English)</label>
                                            <textarea name="description_en" id="description_en" class="form-control" placeholder="Enter category description in english">{{ $categoryDescription_en }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            @php 
                                                $categoryDescription_ar = '';
                                                if (isset($category->description_ar)) $categoryDescription_ar = $category->description_ar; 
                                                if (old('description_ar')) $categoryDescription_ar = old('description_ar'); 
                                            @endphp
                                            <label for="description_ar" class="control-label">Description (Arabic) </label>
                                            <textarea name="description_ar" id="description_ar" class="form-control" placeholder="Enter category description in arabic">{{ $categoryDescription_ar }}</textarea>
                                        </div>

                                        <div class="form-group text-right mt-4">
                                            <a href="{{ route('categories.index') }}" class="btn btn-light">Cancel</a>
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