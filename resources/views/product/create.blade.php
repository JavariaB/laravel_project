@extends('layouts.app')

@section('title', (isset($product->id) ? 'Update' : 'Add') . ' Product')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{{ isset($product->id) ? 'Update' : 'Add' }} Product</h3>
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
                                    <form action="{{ isset($product->id) && !empty($product->id) ? route('products.update', $product->id) : route('products.store') }}" method="post">
                                        @csrf()    

                                        @if (isset($product->id))
                                        <input type="hidden" name="_method" value="put">
                                        @endif

                                        <div class="form-group">
                                            <label for="category" class="control-label">Category <span class="text-danger">*<span></label>
                                            @php 
                                                $categoryId = '';
                                                if (isset($product->category_id)) $categoryId = $product->category_id; 
                                                if (old('category')) $categoryId = old('category');
                                            @endphp
                                            <select name="category" id="category-filter" class="form-control">
                                                <option value="" selected disabled>-- Choose a category --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                                        {{ ucwords($category->name_en) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="name_en" class="control-label">Name (English)<span class="text-danger">*<span></label>
                                            @php 
                                                $productNameEn = '';
                                                if (isset($product->name_en)) $productNameEn = $product->name_en; 
                                                if (old('name_en')) $productNameEn = old('name_en'); 
                                            @endphp
                                            <input type="text" name="name_en" id="name_en" class="form-control" placeholder="Enter product name (English)" value="{{ $productNameEn }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="name_ar" class="control-label">Name (Arabic)<span class="text-danger">*<span></label>
                                            @php 
                                                $productNameAr = '';
                                                if (isset($product->name_ar)) $productNameAr = $product->name_ar; 
                                                if (old('name_ar')) $productNameAr = old('name_ar'); 
                                            @endphp
                                            <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="Enter product name (Arabic)" value="{{ $productNameAr }}">
                                        </div>

                                        <div class="form-group">
                                            @php 
                                                $productDescriptionEn = '';
                                                if (isset($product->description_en)) $productDescriptionEn = $product->description_en; 
                                                if (old('description_en')) $productDescriptionEn = old('description_en'); 
                                            @endphp
                                            <label for="description_en" class="control-label">Description (English)</label>
                                            <textarea name="description_en" id="description_en" class="form-control" placeholder="Enter product description (English)">{{ $productDescriptionEn }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            @php 
                                                $productDescriptionAr = '';
                                                if (isset($product->description_ar)) $productDescriptionAr = $product->description_ar; 
                                                if (old('description_ar')) $productDescriptionAr = old('description_ar'); 
                                            @endphp
                                            <label for="description_ar" class="control-label">Description (Arabic)</label>
                                            <textarea name="description_ar" id="description_ar" class="form-control" placeholder="Enter product description (Arabic)">{{ $productDescriptionAr }}</textarea>
                                        </div>

                                        <div class="form-group text-right mt-4">
                                            <a href="{{ route('products.index') }}" class="btn btn-light">Cancel</a>
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