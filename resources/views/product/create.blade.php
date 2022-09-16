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
                                                        {{ ucwords($category->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="control-label">Name <span class="text-danger">*<span></label>
                                            @php 
                                                $productName = '';
                                                if (isset($product->name)) $productName = $product->name; 
                                                if (old('name')) $productName = old('name'); 
                                            @endphp
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" value="{{ $productName }}">
                                        </div>
                                        <div class="form-group">
                                            @php 
                                                $productDescription = '';
                                                if (isset($product->description)) $productDescription = $product->description; 
                                                if (old('description')) $productDescription = old('description'); 
                                            @endphp
                                            <label for="description" class="control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Enter product description">{{ $productDescription }}</textarea>
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