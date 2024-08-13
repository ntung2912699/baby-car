@extends('client.layout.client_layout')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"></script>
    <style>
        .product-title {
            white-space: nowrap; /* Ngăn không cho văn bản xuống dòng */
            overflow: hidden; /* Ẩn phần văn bản bị tràn ra ngoài */
            text-overflow: ellipsis; /* Thêm dấu chấm ba để chỉ ra rằng văn bản đã bị cắt */
        }

        .noUi-connect {
            background-color: #01d28e !important;
        }
        /* Đặt màu sắc của văn bản trong thanh điều hướng thành màu đen */
        #ftco-navbar .navbar-nav .nav-link {
            color: #000000; /* Màu đen */
        }

        #ftco-navbar .navbar-nav .nav-link:hover {
            color: #333333 !important;; /* Màu xám tối hơn khi di chuột qua */
        }

        .ftco-navbar-light {
            top: 0px !important;
        }

        /* Thêm box-shadow cho toàn bộ thanh điều hướng */
        #ftco-navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Tạo hiệu ứng đổ bóng dưới thanh điều hướng */
            /*border-bottom: 1px solid #000000; !* Đường viền dưới màu đen (có thể tùy chỉnh hoặc loại bỏ) *!*/
        }

        .ftco-navbar-light .navbar-brand {
            color: black;
        }

        /* CSS cho section tìm kiếm */
        .filter-section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f8f9fa; /* Màu nền sáng cho phần tìm kiếm */
            border-radius: 5px; /* Bo tròn góc của phần tìm kiếm */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Thêm bóng đổ nhẹ cho phần tìm kiếm */
        }

        .filter-section .form-group {
            margin-bottom: 1rem;
        }

        .filter-section .btn {
            width: 100%;
        }

        /* CSS cho slider khoảng giá */
        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 8px;
            background: #ddd;
            outline: none;
            opacity: 0.7;
            transition: opacity .2s;
        }

        .slider:hover {
            opacity: 1;
        }

        .slider-labels {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }

        .attribute-list {
            list-style-type: none;
            padding: 0;
        }

        .attribute-list li {
            margin-bottom: 0.5rem;
        }

        .attribute-list {
            list-style-type: none; /* Loại bỏ các dấu chấm đầu mục của danh sách */
            padding: 0;
            margin: 0;
        }

        .attribute-list li {
            margin-bottom: 1rem; /* Thêm khoảng cách dưới mỗi mục danh sách */
            padding: 0.5rem 0; /* Thêm khoảng cách trên và dưới mỗi mục */
            border-bottom: 1px solid #ddd; /* Thêm đường viền dưới mỗi mục danh sách */
        }

        .attribute-list label {
            display: inline-block; /* Hiển thị nhãn theo kiểu khối inline */
            margin-right: 0.5rem; /* Khoảng cách bên phải của nhãn */
        }

        .attribute-list input[type="checkbox"] {
            margin-left: 0.5rem; /* Khoảng cách bên trái của checkbox */
            vertical-align: middle; /* Căn chỉnh checkbox với văn bản */
        }

        /* Ẩn checkbox */
        .visually-hidden {
            position: absolute;
            opacity: 0;
            pointer-events: none;
            height: 0;
            width: 0;
        }

        #attribute-list {
            display: none;
        }

        /* Hiển thị border cho label khi checkbox được chọn */
        .form-check-input:checked + .form-check-label {
            border: 2px solid #01d28e; /* Thay đổi kiểu border theo ý muốn */
            padding: 2px; /* Thay đổi khoảng cách padding theo ý muốn */
            border-radius: 10px;
        }

        /* CSS cho select bình thường */
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #ffffff;
            background-clip: padding-box;
        }

        /* CSS cho select khi bị disabled */
        .form-control:disabled {
            background-color: #d6d6d6 !important; /* Màu xám sáng cho nền */
            color: #6c757d; /* Màu chữ khi bị disabled */
            cursor: not-allowed; /* Thay đổi con trỏ khi hover qua select */
            border-color: #d6d6d6 !important; /* Màu viền khi bị disabled */
            box-shadow: none; /* Loại bỏ bóng đổ khi bị disabled */
        }

        /* Tùy chỉnh kiểu dáng để nhìn rõ hơn khi bị disabled */
        .form-control:disabled option {
            color: #6c757d !important; /* Màu chữ cho các option khi select bị disabled */
        }

    </style>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="filter-section">
                <h3 class="mb-4">{{ __('Bộ Lọc') }}</h3>
                <form action="{{ route('product.search') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="query">{{ __('Từ Khóa') }}</label>
                                <input type="text" class="form-control" id="query" name="query" value="{{ request()->input('query') }}" placeholder="Nhập từ khóa tìm kiếm...">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="producer">{{ __('Hãng Xe') }}</label>
                                <select id="producer" name="producer" class="form-control">
                                    <option value="">{{ __('Tất Cả') }}</option>
                                    @foreach($producers as $producer)
                                        <option value="{{ $producer->id }}" {{ request()->input('producer') == $producer->id || isset($producerTargetId) && $producerTargetId == $producer->id ? 'selected' : '' }}>
                                            {{ $producer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="model">{{ __('Dòng Xe') }}</label>
                                <select id="model" name="model" disabled class="form-control">
                                    <option value="">{{ __('Tất Cả') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="checkbox" id="enable_price_range" name="enable_price_range" {{ request()->input('enable_price_range') ? 'checked' : '' }}>
                                <label for="enable_price_range">{{ __('Khoảng Giá') }}</label>
                                <div id="price_range_section" style="{{ request()->input('enable_price_range') ? '' : 'display: none;' }}">
                                    <div id="price_range_slider"></div>
                                    <div class="slider-labels">
                                        <span id="label_min">{{ __('< 100tr') }}</span>
                                        <span id="label_max">{{ __('> 2 Tỷ') }}</span>
                                    </div>
                                    <input type="hidden" id="price_range_min" name="price_range_min" value="{{ request()->input('price_range_min', 20000000) }}">
                                    <input type="hidden" id="price_range_max" name="price_range_max" value="{{ request()->input('price_range_max', 3100000000) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">{{ __('Danh Kiểu Dáng') }}</label>
                                <select id="category" name="category" class="form-control">
                                    <option value="">{{ __('Tất Cả') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->input('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 row">
                            <div class="form-group col-6">
                                <label for="start_year">{{ __('Năm SX Từ') }}</label>
                                <select id="start_year" name="start_year" class="form-control">
                                    <option value="">{{ __('---') }}</option>
                                    @php
                                        $currentYear = date('Y'); // Năm hiện tại
                                        $startYear = 2000; // Năm bắt đầu
                                    @endphp
                                    @for ($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}" {{ request()->input('start_year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="end_year">{{ __('Đến Năm') }}</label>
                                <select id="end_year" name="end_year" class="form-control">
                                    @php
                                        // Đặt $endYear bằng năm hiện tại nếu không có giá trị từ người dùng
                                        $endYear = request()->input('end_year', $currentYear);
                                    @endphp
                                    <option value="">
                                        {{ __('---') }}
                                    </option>
                                    @for ($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}" {{ $endYear == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <span id="msg-year" style="color: red"></span>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label id="toggle-attributes" style="cursor: pointer; color: #01d28e;">{{ __('Lọc Theo Thuộc Tính') }}</label>
                                <ul class="attribute-list" id="attribute-list" style="display: none;"> <!-- Ẩn danh sách thuộc tính -->
                                    @foreach($attributes as $attribute)
                                        <li class="row" style="padding-left: 1.5%">
                                            <label class="form-check-label" style="color: black">{{ $attribute->name }}</label> :
                                            @foreach($attribute->spec as $spec)
                                                <div style="min-width: 100px; padding-left: 20px">
                                                    <p>
                                                        <input type="checkbox" class="form-check-input attribute-check visually-hidden" id="attribute_{{ $spec->id }}" name="spec[]" value="{{ $spec->id }}" {{ in_array($spec->id, request()->input('spec', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="attribute_{{ $spec->id }}">{{ $spec->value }}</label>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn" style="background-color: #01d28e; color: #FFFFFF">{{ __('Tìm Kiếm') }}</button>
                </form>
            </div>

            @if(isset($products) && count($products) > 0)
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-3">
                            <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                                <div class="car-wrap rounded ftco-animate">
                                    <div class="img rounded d-flex align-items-end"
                                         style="background-image: url({{ $product->thumbnail }});">
                                    </div>
                                    <div class="text">
                                        <h2 class="mb-0 product-title">
                                            {{ $product->name }}
                                        </h2>
                                        <div class="mb-3">
                                            <span class="cat">{{ $product->producer->name }}</span>
                                            <p class="price">{{ $product->price }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <p style="color: #999999"><span>{{ __('Không Có Dữ Liệu') }}</span></p>
                </div>
            @endif

            <div class="row mt-5">
                {{ $products->links('client.vendor.pagination.custom_panigation') }}
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#enable_price_range').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#price_range_section').show();
                } else {
                    $('#price_range_section').hide();
                }
            });

            // Đảm bảo rằng phần khoảng giá có thể kích hoạt khi trang được tải lại với checkbox đã được chọn
            if ($('#enable_price_range').is(':checked')) {
                $('#price_range_section').show();
            } else {
                $('#price_range_section').hide();
            }
        });

        $(document).ready(function() {
            $('#toggle-attributes').on('click', function() {
                $('#attribute-list').toggle(); // Hiển thị hoặc ẩn danh sách thuộc tính khi nhấp vào nhãn
            });
        });

        document.getElementById('start_year').addEventListener('change', validateYears);
        document.getElementById('end_year').addEventListener('change', validateYears);

        function validateYears() {
            const startYear = parseInt(document.getElementById('start_year').value);
            const endYear = parseInt(document.getElementById('end_year').value);
            const msgYear = document.getElementById('msg-year');

            // Xóa thông báo cũ
            msgYear.innerHTML = '';

            // Kiểm tra và hiển thị thông báo nếu năm bắt đầu không hợp lệ
            if (!startYear && endYear) {
                $('#start_year').css('border', '1px solid red');
                msgYear.innerHTML = '{{ __('Vui lòng nhập năm bắt đầu') }}';
            } else {
                $('#start_year').css('border', '1px solid #ddd');
            }

            // Kiểm tra và hiển thị thông báo nếu năm kết thúc không hợp lệ
            if (!endYear && startYear) {
                $('#end_year').css('border', '1px solid red');
                msgYear.innerHTML = '{{ __('Vui lòng nhập năm kết thúc') }}';
            } else {
                $('#end_year').css('border', '1px solid #ddd');
            }

            // Kiểm tra nếu năm bắt đầu lớn hơn năm kết thúc
            if (startYear && endYear && startYear > endYear) {
                msgYear.innerHTML = '{{ __('Năm bắt đầu không thể lớn hơn năm kết thúc.') }}';
                $('#start_year').css('border', '1px solid red');
                $('#end_year').css('border', '1px solid red');
                document.getElementById('end_year').value = ''; // Reset giá trị năm kết thúc
            }

            // Nếu tất cả đều hợp lệ
            if (startYear && endYear && startYear <= endYear) {
                $('#start_year').css('border', '1px solid #ddd');
                $('#end_year').css('border', '1px solid #ddd');
                msgYear.innerHTML = '';
            }
        }


        $(document).ready(function() {
            var slider = document.getElementById('price_range_slider');

            noUiSlider.create(slider, {
                start: [$('#price_range_min').val(), $('#price_range_max').val()],
                connect: true,
                range: {
                    'min': 20000000,
                    'max': 3100000000
                },
                step: 10000000,
                format: {
                    to: function (value) {
                        return Math.round(value);
                    },
                    from: function (value) {
                        return Number(value);
                    }
                }
            });

            slider.noUiSlider.on('update', function (values, handle) {
                var minPrice = values[0];
                var maxPrice = values[1];

                $('#price_range_min').val(minPrice);
                $('#price_range_max').val(maxPrice);

                $('#label_min').text(formatCurrency(minPrice) + 'đ');
                if(parseInt(maxPrice) > 3000000000) {
                    $('#label_max').text('> ' + formatCurrency(3000000000) + 'đ');
                } else {
                    $('#label_max').text(formatCurrency(maxPrice) + 'đ');
                }
            });

            function formatCurrency(value) {
                return new Intl.NumberFormat().format(value);
            }
        });

        $(document).ready(function() {
            if ($('input.attribute-check:checked').length > 0) {
                $('#attribute-list').css('display', 'block');
            } else {
                $('#attribute-list').css('display', 'none');
            }
        });

        $(document).ready(function() {
            // Khi trang tải lại, giữ giá trị đã chọn
            var selectedModel = '{{ request()->input('model') }}';

            // Nếu có giá trị category đã chọn, bật và chọn nó
            if (selectedModel) {
                $('#model').val(selectedModel).prop('disabled', false);
            }

            var producerIdTarget = $('#producer').val();
            var modelSelect = $('#model');
            if (producerIdTarget) {
                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '{{ route('model-client.get-by-producer', ['producerId' => '__producerId__']) }}'.replace('__producerId__', producerIdTarget),
                    method: 'GET',
                    success: function(response) {
                        // Làm sạch danh sách chọn dòng xe
                        modelSelect.empty();

                        // Thêm option "Tất Cả"
                        modelSelect.append('<option value="">{{ __("Tất Cả") }}</option>');

                        // Điền các dòng xe vào select
                        $.each(response.data, function(index, model) {
                            modelSelect.append('<option value="' + model.id + '">' + model.name + '</option>');
                        });

                        // Kích hoạt select dòng xe
                        modelSelect.prop('disabled', false);

                        // Nếu có giá trị category đã chọn, chọn nó
                        if (selectedModel) {
                            modelSelect.val(selectedModel);
                        }
                    },
                    error: function(xhr) {
                        console.error('Có lỗi xảy ra khi lấy dữ liệu dòng xe:', xhr);
                    }
                });

            }

            $('#producer').change(function() {
                var producerId = $(this).val();
                var modelSelect = $('#model');
                selectedModel = null;
                if (producerId) {
                    // Gửi yêu cầu AJAX
                    $.ajax({
                        url: '{{ route('model-client.get-by-producer', ['producerId' => '__producerId__']) }}'.replace('__producerId__', producerId),
                        method: 'GET',
                        success: function(response) {
                            // Làm sạch danh sách chọn dòng xe
                            modelSelect.empty();

                            // Thêm option "Tất Cả"
                            modelSelect.append('<option value="">{{ __("Tất Cả") }}</option>');

                            // Điền các dòng xe vào select
                            $.each(response.data, function(index, model) {
                                modelSelect.append('<option value="' + model.id + '">' + model.name + '</option>');
                            });

                            // Kích hoạt select dòng xe
                            modelSelect.prop('disabled', false);

                            // Nếu có giá trị category đã chọn, chọn nó
                            if (selectedModel) {
                                modelSelect.val(selectedModel);
                            }
                        },
                        error: function(xhr) {
                            console.error('Có lỗi xảy ra khi lấy dữ liệu dòng xe:', xhr);
                        }
                    });
                } else {
                    // Nếu không có hãng xe được chọn, giữ select dòng xe disabled
                    modelSelect.empty().append('<option value="">{{ __("Tất Cả") }}</option>').prop('disabled', true);
                }
            });
        });
    </script>
@stop
