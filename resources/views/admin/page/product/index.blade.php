@extends('admin.layout_admin.main_layout')

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">{{ trans('Quản Lý Option') }}</h3>
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
                <a href="#">{{ trans('Sản Phẩm') }}</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ trans('Danh Sách Sản Phẩm') }}</h4>
                        <a href="{{ route('product-form.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            {{ trans('Tạo Mới') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="multi-filter-select_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <form method="GET" action="{{ route('product.index') }}" id="paginationProductForm">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="multi-filter-select_length">
                                            <label>{{ trans('Hiển thị ') }}
                                                <select
                                                    name="perPage" aria-controls="multi-filter-select"
                                                    class="form-control form-control-sm" onchange="document.getElementById('paginationProductForm').submit();">
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
                                                <span class="input-icon-addon" onclick="document.getElementById('paginationProductForm').submit();">
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
                                                <a style="text-decoration: none; color: black" href="{{ route('product.index', ['sort' => 'id', 'order' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' => request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th style="min-width: 130px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending"
                                            >
                                                {{ trans('Kiểu Dáng') }}
                                            </th>
                                            <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending"
                                            >
                                                {{ trans('Hãng SX') }}
                                            </th>
                                            <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending"
                                            >
                                                {{ trans('Dòng Xe') }}
                                            </th>
                                            <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending"
                                            >
                                                {{ trans('Trạng Thái') }}
                                            </th>
                                            <th style="min-width: 250px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending"
                                            >
                                                {{ trans('Tên') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('product.index', ['sort' => 'name', 'order' => $sortField == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' => request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending"
                                            >
                                                {{ trans('Giá') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('product.index', ['sort' => 'price', 'order' => $sortField == 'price' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' => request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th style="min-width: 120px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Office: activate to sort column ascending"
                                            >{{ trans('Ngày Tạo') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('product.index', ['sort' => 'created_at', 'order' => $sortField == 'created_at' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' => request('perPage'), 'searchKey' => $searchKey]) }}">
                                                    <i class="fas fa-sort"></i>
                                                </a>
                                            </th>
                                            <th style="min-width: 120px" aria-controls="multi-filter-select"
                                                rowspan="1" colspan="1"
                                                aria-label="Age: activate to sort column ascending"
                                            >{{ trans('Ngày Sửa') }}
                                                <a style="text-decoration: none; color: black" href="{{ route('product.index', ['sort' => 'updated_at', 'order' => $sortField == 'updated_at' && $sortOrder == 'asc' ? 'desc' : 'asc', 'perPage' == request('perPage'), 'searchKey' => $searchKey]) }}">
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
                                        @foreach($product_data as $product)
                                            <a href="{{ route('product-form.edit', ['id' => $product->id ]) }}">
                                                <tr role="row" class="odd">
                                                    <td class="text-start">{{ $product->id }}</td>
                                                    <td class="text-start">{{ $product->category->name }}</td>
                                                    <td class="text-start">{{ $product->producer->name }}</td>
                                                    <td class="text-start">{{ $product->model->name }}</td>
                                                    <td class="text-start">{{ $product->status->name }}</td>
                                                    <td class="text-start">
                                                        <div class="avatar">
                                                            <img src="{{ asset($product->thumbnail) }}" alt="..." class="avatar-img rounded-circle">
                                                        </div>
                                                        {{ $product->name }}
                                                    </td>
                                                    <td class="text-start">{{ $product->price }}</td>
                                                    <td class="text-start">{{ $product->created_at }}</td>
                                                    <td class="text-start">{{ $product->updated_at }}</td>
                                                    <td class="text-start">
                                                        <div class="form-button-action">
                                                            <a href="{{ route('product-form.edit', ['id' => $product->id ]) }}" type="button" data-bs-toggle="tooltip" title=""
                                                               class="btn btn-link btn-primary btn-lg"
                                                               data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                                    class="btn btn-link btn-danger" data-original-title="Remove">
                                                                <i class="fa fa-times"
                                                                   onclick="DeleteProduct({{ $product->id }})"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </a>
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
                                    {{ $product_data->appends(['perPage' => request('perPage'), 'searchKey' => $searchKey, ])->links('admin.vendor.pagination.custom_pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.page.common.js.common_js')
    @include('admin.page.product.js.logic_js_index_product')
@stop
