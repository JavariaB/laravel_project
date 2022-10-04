@extends('layouts.app')

@section('title', 'Language Lines')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Language Lines</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="javascript:void(0);" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu">
                                    <em class="icon ni ni-more-v"></em>
                                </a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a href="{{ route('language-lines.create') }}" class="btn btn-primary">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Add Language Line</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner position-relative card-tools-toggle">
                                @if (session()->has('success'))
                                <div class="alert alert-success">
                                    <b>Yahoo!</b> {{ session()->get('success') }}
                                </div>
                                @endif
                                <table id="language-lines-dt" class="table">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th><span class="sub-text">#</span></th>
                                            <th><span class="sub-text">Key</span></th>
                                            <th><span class="sub-text">Title (English)</span></th>
                                            <th><span class="sub-text">Title (Arabic)</span></th>
                                            <th><span class="sub-text">Description (English)</span></th>
                                            <th><span class="sub-text">Description (Arabic)</span></th>
                                            <th><span class="sub-text">Actions</span></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $("#language-lines-dt").DataTable({
        ajax: '{{ route("language-lines.dt") }}',
        processing: true,
        serverSide: true,
        scrollX: false,
        autoWidth: true,
        stateSave: true,
        columns: [{
                data: 'DT_RowIndex',
                name: 'id',
                orderable: false,
                searchable: false
            },
            {
                data: 'key',
                name: 'key'
            },
            {
                data: 'title_en',
                name: 'title_en'
            },
            {
                data: 'title_ar',
                name: 'title_ar'
            },
            {
                data: 'description_en',
                name: 'description_en'
            },
            {
                data: 'description_ar',
                name: 'description_ar'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ],
        createdRown: function(row, data, index) {
            $(row).addClass('nk-tb-item');
        }
    });
</script>
@endsection