@extends('admin.layout_admin.main_layout')

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">{{ trans('Quản Lý Hãng Xe') }}</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.index') }}">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="fas fa-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ trans('Quản Lý') }}</a>
            </li>
            <li class="separator">
                <i class="fas fa-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ trans('Hãng Xe') }}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('Danh Sách Hãng Xe') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="multi-filter-select_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <form method="GET" action="{{ route('producer.index') }}" id="paginationProducerForm">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="multi-filter-select_length">
                                            <label>{{ trans('Hiển thị ') }}
                                                <select
                                                    name="perPage" aria-controls="multi-filter-select"
                                                    class="form-control form-control-sm" onchange="document.getElementById('paginationProducerForm').submit();">
                                                    <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                                {{ trans(' mục') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="multi-filter-select_filter" class="dataTables_filter">
                                            <label><input type="text" name="searchKey" value="{{ $searchKey }}" class="form-control form-control-sm" aria-controls="multi-filter-select" placeholder="Tìm kiếm...">
                                                <span class="input-icon-addon" onclick="document.getElementById('paginationProducerForm').submit();">
                                                <i class="fa fa-search"></i>
                                            </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="multi-filter-select"
                                           class="display table dataTable" role="grid"
                                           aria-describedby="multi-filter-select_info">
                                        <thead>
                                        <tr role="row">
                                            <th style="min-width: 30px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Name: activate to sort column descending"
                                                aria-sort="ascending">
                                                {{ trans('ID') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('producer.index', ['sort' => 'id', 'order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' => request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th style="min-width: 170px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending"
                                            >
                                                {{ trans('Tên') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('producer.index', ['sort' => 'name', 'order' => $sortField == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' => request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Office: activate to sort column ascending"
                                            >{{ trans('Ngày Tạo') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('producer.index', ['sort' => 'created_at', 'order' => $sortField == 'created_at' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' => request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Age: activate to sort column ascending"
                                            >{{ trans('Ngày Sửa') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('producer.index', ['sort' => 'updated_at', 'order' => $sortField == 'updated_at' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' == request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Start date: activate to sort column ascending"
                                            >{{ trans('Thao Tác') }}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($producer_data as $producer)
                                            <tr role="row" class="odd">
                                                <td class="text-start">{{ $producer->id }}</td>
                                                <td class="text-start">
                                                    <div class="avatar">
                                                        <img src="{{ asset($producer->logo) }}" alt="..." class="avatar-img rounded-circle"
                                                             onclick="EditProducerLogo({{ $producer->id }}, '{{ $producer->logo }}')">
                                                    </div>
                                                    {{ $producer->name }}
                                                </td>
                                                <td class="text-start">{{ $producer->created_at }}</td>
                                                <td class="text-start">{{ $producer->updated_at }}</td>
                                                <td class="text-start">
                                                    <div class="form-button-action">
                                                        <button type="button" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-primary btn-lg"
                                                                data-original-title="Edit Task">
                                                            <i class="fa fa-edit"
                                                               onclick="EditProducer({{ $producer->id }}, '{{ $producer->name }}')"></i>
                                                        </button>
                                                        <button type="button" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                            <i class="fa fa-times"
                                                               onclick="DeleteProducer({{ $producer->id }})"></i>
                                                        </button>
                                                        <a type="button" href="{{ route('model.index', ['id' => $producer->id]) }}" data-bs-toggle="tooltip" title=""
                                                           class="btn btn-link btn-secondary" data-original-title="More">
                                                            <i class="fas fa-folder-open"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="multi-filter-select_info" role="status"
                                         aria-live="polite">Hiển thị 1 đến {{ $currentTotal }} trong tổng số {{ $countTotal }} mục
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    {{ $producer_data->appends(['perPage' => request('perPage'), 'searchKey' => $searchKey, ])->links('admin.vendor.pagination.custom_pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <form name="add-producer-post-form" enctype="multipart/form-data" id="add-producer-post-form" method="post" action="{{url('/api/admin/producer/store')}}">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">{{ trans('Tạo Hãng Xe Mới') }}</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="form-group">
                            <label for="producer-name">{{ trans('Tên Hãng Xe') }}</label><span style="color: red"> *</span>
                            <input type="text" class="form-control" name="name" id="producer-name" placeholder="{{ trans('Nhập Tên Hãng Xe') }}">
                            <span id="msg-producer-name" style="color: red"></span><br>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('Logo Hãng Xe') }}</label><span style="color: red"> *</span><br>
                            <span id="msg-logo-producer" style="color: red"></span><br>
                            <label for="producer-logo" id="logo-require-producer">
                                <i id="image-upload" class="fas fa-file-upload"></i>
                                <div id="preview-image" hidden>
                                    <img id="output-logo" alt="..." class="imagecheck-image">
                                    <i id="image-upload-icon" class="fas fa-file-upload"></i>
                                </div>
                            </label>
                            <input type="file" class="form-control-file" id="producer-logo" hidden name="logo" accept="image/*" onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary">{{ trans('Gửi') }}</button>
                        <button type="button" class="btn btn-secondary" onclick="clearForm()">{{ trans('Cancel') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('admin.page.producer.js.js_logic_producer')
@stop
