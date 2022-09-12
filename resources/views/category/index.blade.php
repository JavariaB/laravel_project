@extends('layouts.app')

@section('title', 'Categories')

@section('styles')
<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> -->
@endsection

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Categories</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="javascript:void(0);" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu">
                                    <em class="icon ni ni-more-v"></em>
                                </a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a href="javascript:void(0);" class="btn btn-primary">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Add Category</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        <table class="table" id="categories-dt" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
        $("#categories-dt").DataTable({
            ajax: '{{ route("categories.dt") }}',
            processing: true,
            serverSide: true,
            scrollX: true,
            autoWidth: true,
            stateSave: true,
            columns: [
                {data: 'DT_RowIndex', name: 'id', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                // {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });
    </script>
@endsection