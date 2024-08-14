@extends('admin.layout_admin.main_layout')

@section('content')
    <style>
        a {
            color: black !important;
            text-decoration: none !important;
        }
    </style>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ __('Quản Lý Tổng Quan') }}</h3>
{{--                <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6>--}}
            </div>
{{--            <div class="ms-md-auto py-2 py-md-0">--}}
{{--                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>--}}
{{--                <a href="#" class="btn btn-primary btn-round">Add Customer</a>--}}
{{--            </div>--}}
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Khách Hàng') }}</p>
                                    <h4 class="card-title">{{ $userCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Xe Đã Bán') }}</p>
                                    <h4 class="card-title">{{ $productSold }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-luggage-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">{{ __('Dòng Tiền') }}</p>
                                    <h4 class="card-title">{{ $totalPrice }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">{{ __('Xe Mới Về')  }}</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="multi-filter-select_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
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
                                                </th>
                                                <th aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Giá') }}
                                                </th>
                                                <th style="min-width: 120px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                >{{ trans('Ngày Tạo') }}
                                                </th>
                                                <th style="min-width: 120px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                >{{ trans('Ngày Sửa') }}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach( $productNew as $product)
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
                                                        <a  href="{{ route('product-form.edit', ['id' => $product->id ]) }}">
                                                            {{ $product->name }}
                                                        </a>
                                                    </td>
                                                    <td class="text-start">{{ $product->price }}</td>
                                                    <td class="text-start">{{ $product->created_at }}</td>
                                                    <td class="text-start">{{ $product->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
@stop
