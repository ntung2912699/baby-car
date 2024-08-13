@extends('admin.layout_admin.main_layout')

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">{{ trans('Quản Lý Dòng Xe') }}</h3>
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
                <a href="{{ route('producer.index') }}">{{ trans('Hãng Xe') }}</a>
            </li>
            <li class="separator">
                <i class="fas fa-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#"><i class="fas fa-expand"></i></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ trans('Danh Sách') }} {{ $producerTarget->name }}</h4>
                        <button
                            class="btn btn-primary btn-round ms-auto"
                            data-bs-toggle="modal"
                            data-bs-target="#addRowModal"
                        >
                            <i class="fa fa-plus"></i>
                            {{ trans('Tạo Mới') }}
                        </button>
                        <a href="{{ route('producer.index') }}"
                           class="btn btn-secondary btn-round">
                            <i class="fas fa-arrow-circle-left"></i>
                            {{ trans('Back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('model.store') }}" id="add-model-post-form">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">{{ trans('Tạo Mới') }}</span>
                                            <span class="fw-light"> {{ trans('Dòng Xe') }} </span>
                                        </h5>
                                        <button
                                            type="button"
                                            class="close closeModal"
                                            data-dismiss="modal"
                                            aria-label="Close"
                                        >
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="small">
                                            {{ trans('Tạo một dòng xe mới bằng biểu mẫu này, hãy đảm bảo bạn điền đầy đủ thông tin') }}
                                        </p>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>{{ trans('Tên Hãng Xe') }}</label>
                                                    <select class="form-select" id="producerSelect" disabled>
                                                        @foreach($producers as $producer)
                                                            <option value="{{ $producer->id }}" {{ $producer->id == request('id') ? 'selected' : '' }}>{{ $producer->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group form-group-default">
                                                    <label>{{ trans('Tên Dòng Xe') }}</label>
                                                    <input
                                                        id="model-name"
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="{{ trans('Nhập tên dòng xe ...') }}"
                                                    />
                                                    <span style="color: red" id="msg-model-name"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button
                                            type="submit"
                                            id="addRowButton"
                                            class="btn btn-primary"
                                        >
                                            {{ trans('Gửi') }}
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-secondary closeModal"
                                            data-dismiss="modal"
                                        >
                                            {{ trans('Đóng') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div id="multi-filter-select_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <form method="GET" action="{{ route('model.index', ['id' => request('id')]) }}" id="paginationAttributeForm">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="multi-filter-select_length">
                                        <label>{{ trans('Hiển thị ') }}
                                            <select
                                                name="perPage" aria-controls="multi-filter-select"
                                                class="form-control form-control-sm" onchange="document.getElementById('paginationModelForm').submit();">
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
                                            <span class="input-icon-addon" onclick="document.getElementById('paginationModelForm').submit();">
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
                                                <a style="text-decoration: none; color: black" href="{{ route('model.index', ['id' => request('id'), 'sort' => 'id', 'order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' => request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th style="min-width: 170px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending"
                                            >
                                                {{ trans('Hãng Xe') }}
                                            </th>
                                            <th style="min-width: 170px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending"
                                                >
                                               {{ trans('Tên Dòng Xe') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('model.index', ['id' => request('id'),'sort' => 'value', 'order' => $sortField == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' => request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Office: activate to sort column ascending"
                                                >{{ trans('Ngày Tạo') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('model.index', ['id' => request('id'),'sort' => 'created_at', 'order' => $sortField == 'created_at' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' => request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Age: activate to sort column ascending"
                                                >{{ trans('Ngày Sửa') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('model.index', ['id' => request('id'),'sort' => 'updated_at', 'order' => $sortField == 'updated_at' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' == request('perPage'), 'searchKey' => $searchKey]) }}">
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
                                        @foreach($models as $model)
                                            <tr role="row" class="odd">
                                                <td class="text-start">{{ $model->id }}</td>
                                                <td class="text-start">{{ $model->producer->name }}</td>
                                                <td class="text-start">{{ $model->name }}</td>
                                                <td class="text-start">{{ $model->created_at }}</td>
                                                <td class="text-start">{{ $model->updated_at }}</td>
                                                <td class="text-start">
                                                    <div class="form-button-action">
                                                        <button type="button" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-primary btn-lg"
                                                                data-original-title="Edit Task">
                                                            <i class="fa fa-edit"
                                                               onclick="EditModel({{ $model->id }}, '{{ $model->name }}', {{ $producers }}, {{ request('id') }})"></i>
                                                        </button>
                                                        <button type="button" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                            <i class="fa fa-times"
                                                               onclick="DeleteModel({{ $model->id }})"></i>
                                                        </button>
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
                                    {{ $models->appends(['perPage' => request('perPage'), 'searchKey' => $searchKey, ])->links('admin.vendor.pagination.custom_pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.page.model.js.js_logic_model')
@stop
