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

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @php
                                                    $titleEn = $languageLine->text['title_en'];
                                                    if (old('title_en')) $titleEn = old('title_en');
                                                    @endphp
                                                    <label for="title_en" class="control-label">Title (English) <span class="text-danger">*<span></label>
                                                    <input type="text" name="title_en" id="title_en" class="form-control" placeholder="Enter translation title" value="{{ $titleEn }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @php
                                                    $titleAr = $languageLine->text['title_ar'];
                                                    if (old('title_ar')) $titleAr = old('title_ar');
                                                    @endphp
                                                    <label for="title_ar" class="control-label">Title (Arabic) <span class="text-danger">*<span></label>
                                                    <input type="text" name="title_ar" id="title_ar" class="form-control" placeholder="Enter translation title" value="{{ $titleAr }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @php
                                                    $descriptionEn = $languageLine->text['description_en'];
                                                    if (old('description_en')) $descriptionEn = old('description_en');
                                                    @endphp
                                                    <label for="description_en" class="control-label">Description (English) <span class="text-danger">*<span></label>
                                                    <textarea type="text" name="description_en" id="description_en" class="form-control" placeholder="Enter translation description">{{ $descriptionEn }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @php
                                                    $descriptionAr = $languageLine->text['description_ar'];
                                                    if (old('description_ar')) $descriptionAr = old('description_ar');
                                                    @endphp
                                                    <label for="description_ar" class="control-label">Description (Arabic) <span class="text-danger">*<span></label>
                                                    <textarea type="text" name="description_ar" id="description_ar" class="form-control" placeholder="Enter translation description">{{ $descriptionAr }}</textarea>
                                                </div>
                                            </div>
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