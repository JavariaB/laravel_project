@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner position-relative card-tools-toggle">
                                <div class="nk-block nk-block-lg">
                                    <div class="row g-gs">
                                        <div class="col-lg-12">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner">
                                                    <div class="card-head">
                                                        <h5 class="card-title">Add Product</h5>
                                                    </div>
                                                    <form action="{{ isset($product->id) && !empty($product->id) 
                                                            ? route('products.update', $product->id) 
                                                            : route('products.store') }}" method="post">

                                                        @if (isset($product->id))
                                                        <input type="hidden" name="_method" value="put">
                                                        @endif

                                                        <div class="form-group">
                                                            <label for="name" class="control-label">Name <span class="text-danger">*<span></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required value="{{ isset($product->name) ? $product->name : '' }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description" class="control-label">Description</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea name="description" id="description" class="form-control" placeholder="Enter category description">{{ isset($product->description) ? $product->description : '' }}</textarea>
                                                        </div>
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Save</button>
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
            </div>
        </div>
    </div>
</div>
@endsection