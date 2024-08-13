@extends('admin.layout_admin.main_layout')

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">{{ trans('Quản Lý Sản Phẩm') }}</h3>
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
            <li class="separator">
                <i class="fas fa-arrow-right"></i>
            </li>
            <li class="separator">
                <i class="fas fa-plus"></i> {{ trans('Tạo Mới') }}
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form id="add-product-post-form" method="POST" action="{{ route('product.store') }}">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{ trans('Tạo Mới Sản Phẩm') }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="card-title">{{ trans('Thông Tin Sản Phẩm') }}</div>
                                <div class="form-group">
                                    <label class="form-label d-block">{{ __('Chọn Trạng Thái') }}<span style="color: red"> *</span></label>
                                    <div id="status-form"></div>
                                    <span style="color: red" id="msg-status"></span>
                                </div>
                                <div class="form-group form-group-default" id="categorySelectContent"></div>
                                <span style="color: red" id="msg-categorySelect"></span>
                                <div class="form-group form-group-default" id="producerSelectContent"></div>
                                <span style="color: red" id="msg-producerSelect"></span>
                                <div class="form-group form-group-default" hidden id="modelSelectContent"></div>
                                <span style="color: red" id="msg-modelSelect"></span>
                                <div class="form-group">
                                    <label for="name">{{ __('Tên Sản Phẩm') }}</label><span style="color: red"> *</span><br>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('Nhập tên sản phẩm') }}">
                                    <span style="color: red" id="msg-name"></span>
                                </div>
                                <div class="form-group">
                                    <label for="price">{{ __('Giá Sản Phẩm') }}</label><span style="color: red"> *</span><br>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="{{ __('Nhập giá sản phẩm') }}">
                                    <span style="color: red" id="msg-price"></span>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('Ảnh Chính Sản Phẩm') }}</label><span style="color: red"> *</span><br>
                                    <span style="color: red" id="msg-thumbnail"></span>
                                    <span id="msg-thumbnail" style="color: red"></span><br>
                                    <label for="thumbnail-upload" id="thumbnail-require" style="text-align: center; width: 100%">
                                        <i id="thumbnail-image-upload" class="fas fa-file-upload"></i>
                                        <div id="preview-image" hidden>
                                            <img id="output-thumbnail" alt="..." class="imagecheck-image">
                                            <i id="thumbnail-image-icon" class="fas fa-file-upload"></i>
                                        </div>
                                    </label>
                                    <input type="file" class="form-control-file" name="thumbnail" id="thumbnail-upload" hidden
                                           accept="image/*" onchange="loadFile(event)">
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('Ảnh Phụ Sản Phẩm') }}</label><span style="color: red"> *</span><br>
                                    <span id="msg-gallery" style="color: red"></span><br>
                                    <div class="image-preview" id="gallery-require">
                                        <label for="gallery-upload" id="icon-add-gallery">
                                            <i class="fas fa-plus"></i>
                                        </label>
                                    </div>
                                    <input type="file" class="form-control-file" name="gallery[]" multiple id="gallery-upload" hidden
                                           accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Mô Tả Sản Phẩm') }}</label>
                                    <textarea class="form-control" name="description" id="description" rows="20"></textarea>
                                    <span style="color: red" id="msg-description"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="card-title">{{ trans('Tính Năng Sản Phẩm') }} <i style="font-size: 15px" class="fas fa-plus-circle" onclick="CreateAttribute()"></i></div>
                                <div id="attribute-form"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-primary">Submit</button>
                        <button class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('admin.page.product.js.logic_js_create_product')
@stop
