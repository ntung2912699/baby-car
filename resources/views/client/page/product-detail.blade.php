@extends('client.layout.client_layout')

@section('content')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>

        /* styles.css */
        .image-zoom-container {
            position: relative;
            display: inline-block;
        }

        #zoom-image {
            width: 100%;
            height: auto;
        }

        #zoom-lens {
            position: absolute;
            border: 2px solid #000;
            width: 100px;
            height: 100px;
            cursor: crosshair;
        }

        #zoom-result {
            position: absolute;
            border: 1px solid #000;
            width: 300px;
            height: 300px;
            overflow: hidden;
            top: 0;
            left: 110%;
            background-repeat: no-repeat;
            background-size: 100%;
        }

        .product-title {
            white-space: nowrap; /* Ngăn không cho văn bản xuống dòng */
            overflow: hidden; /* Ẩn phần văn bản bị tràn ra ngoài */
            text-overflow: ellipsis; /* Thêm dấu chấm ba để chỉ ra rằng văn bản đã bị cắt */
        }

        /* Đặt màu sắc của văn bản trong thanh điều hướng thành màu đen */
        #ftco-navbar .navbar-nav .nav-link {
            color: #000000 !important; /* Màu đen */
        }

        #ftco-navbar .navbar-nav .nav-link:hover {
            color: #333333 !important; /* Màu xám tối hơn khi di chuột qua */
        }

        .ftco-navbar-light {
            top: 0px !important;
        }

        /* Thêm box-shadow cho toàn bộ thanh điều hướng */
        #ftco-navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Tạo hiệu ứng đổ bóng dưới thanh điều hướng */
        }

        .ftco-navbar-light .navbar-brand {
            color: black !important;
        }

        /* Thêm box-shadow cho carousel */
        #productCarousel {
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Tạo hiệu ứng đổ bóng */
            border-radius: 8px; /* Thêm bo góc nếu cần */
            overflow: hidden; /* Đảm bảo rằng các phần tử không bị tràn ra ngoài */
        }

        #productCarousel .carousel-inner {
            height: 100%;
        }

        #productCarousel .carousel-item img {
            width: 100%;
            height: auto;
            object-fit: cover; /* Đảm bảo hình ảnh không bị biến dạng */
        }

        #productCarousel .carousel-control-prev,
        #productCarousel .carousel-control-next {
            width: 5%;
            color: #1089ff; /* Màu sắc của các nút điều khiển */
        }

        #productCarousel .carousel-control-prev-icon,
        #productCarousel .carousel-control-next-icon {
            background-color: rgba(255, 255, 255, 0.5); /* Nền của các biểu tượng điều khiển */
            border-radius: 50%; /* Đổi hình dạng thành hình tròn */
        }

        /* Modal Custom Style */
        .modal-thumbnail {
            max-width: 100%; /* Điều chỉnh kích thước modal cho các thiết bị di động */
            /*margin: 5vh auto; !* Thêm khoảng cách từ đầu màn hình cho thiết bị di động *!*/
            padding-top: 80px;
        }

        .modal-thumbnail .modal-content {
            border-radius: 0;
        }

        .modal-thumbnail .modal-body {
            padding: 0;
            position: relative;
            overflow: hidden; /* Đảm bảo rằng các phần tử không bị tràn ra ngoài */
        }

        .modal-thumbnail .modal-body img {
            width: 100%;
            height: auto;
            cursor: pointer;
            transition: transform 0.3s ease;
            touch-action: none; /* Vô hiệu hóa các hành động chạm mặc định */
        }

        .modal-thumbnail .close-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 2rem;
            color: #fff;
            cursor: pointer;
            z-index: 1050;
        }

        .modal-thumbnail .modal-content img.zoomed {
            transform: scale(3);
        }

        @media (max-width: 768px) {
            .modal-dialog {
                margin-top: 10vh; /* Thêm khoảng cách trên cho thiết bị di động */
            }
        }

        @media (min-width: 769px) {
            .modal-dialog {
                max-width: 60%; /* Kích thước modal cho các thiết bị PC */
                margin: auto; /* Đảm bảo modal nằm ở giữa màn hình */
            }
        }

        .zoomable {
            cursor: grab; /* Hiển thị con trỏ khi di chuột lên hình ảnh */
            transition: transform 0.1s ease; /* Hiệu ứng chuyển động khi zoom */
        }

        .image-container {
            overflow: hidden; /* Giới hạn hình ảnh trong khung */
            position: relative; /* Để có thể kéo hình ảnh */
        }

        .modal {
            overflow: hidden; /* Ngăn không cho ảnh tràn ra ngoài modal */
        }

        .modal-content {
            padding: 0; /* Không có padding để ảnh không bị giãn cách */
        }

        .modal-body {
            display: flex;
            justify-content: center; /* Căn giữa nội dung modal */
            align-items: center; /* Căn giữa theo chiều dọc */
        }

        #caculateBox {
            padding: 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            background-color: #f5f2f2;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Thêm shadow */
        }

    </style>

    <section class="ftco-section ftco-car-details">
        <div class="container" style="border-bottom: 2px solid #dedede">
            <div class="row">
                <div class="col-12">
                    <div class="text text-center">
                        <span class="subheading">{{ $product->producer->name }} > {{ $product->category->name }} > {{ $product->model->name }}</span>
                        <h2>{{ $product->name }}</h2>
                        <h2 style="color: #1089ff">{{ $product->price }}</h2>
                    </div>
                </div>
                <!-- Carousel -->
                <div class="col-md-6">
                    <div id="productCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#productCarousel" data-slide-to="0" class="active"></li>
                            @foreach($gallery as $index => $image)
                                @if($image)
                                    <li data-target="#productCarousel" data-slide-to="{{ $index + 1 }}"></li>
                                @endif
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset($product->thumbnail) }}" alt="First slide">
                            </div>
                            @foreach($gallery as $image)
                                @if($image)
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{ asset($image) }}" alt="Slide">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <p style="padding-top: 30px;">{{ $product->description }}</p>

                    <div class="row justify-content-center" style="padding-bottom: 30px;">
                        <!-- Button to open modal -->
                        <div class="col-md-6" style="padding: 5px">
                            <button type="button" class="btn btn-lg btn-block" style="background-color: #01d28e; color: #FFFFFF" data-toggle="modal" data-target="#myModal">
                                {{__('Nhận Tư Vấn Chi Tiết')}}
                            </button>
                        </div>
                        <div class="col-md-6" style="padding: 5px">
                            <button type="button" class="btn btn-lg btn-block" style="background-color: #000000; color: #FFFFFF" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-phone"></i>{{__(' 0362912699')}}
                            </button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{__('Điền Thông Tin Liên Hệ')}}</h5>
                                    <span class="close-icon" data-dismiss="modal" aria-label="Close">&times;</span>
                                </div>
                                <div class="modal-body" style="display: flow">
                                    <form>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">{{__('Tên')}}</label>
                                            <input type="text" class="form-control" name="name" id="name-info" placeholder="Nguyễn Văn A">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">{{__('Số Điện Thoại')}}</label>
                                            <input type="text" class="form-control" name="phone-number" id="phone-info" placeholder="0999999999">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">{{ __('Đóng') }}</button>
                                    <button id="send-info" type="button" onclick="submitForm()" class="btn btn-primary">{{ __('Gửi') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chi tiết xe -->
                <div class="col-md-6">
                    <div class="car-details-text">
                        <div class="row">
                            @foreach($attributeByProduct as $attr)
                                <div class="col-md-6 col-sm-6">
                                    <div class="attribute-card">
                                        <div class="attribute-content">
                                            <h5 class="attribute-name">
                                                {{ $attr->attribute->name }}
                                            </h5>
                                            <p class="attribute-value">
                                                {{ $attr->value }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="caculateBox">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 style="color: #1089ff">{{ __('Tổng Chi Phí Ước Tính') }}</h5>
                            <form id="feeForm">
                                <div class="form-group">
                                    <div>
                                        {{ __('Giá Xe') }} - {{ $product->price }}<br>
                                        <div id="feeListContainer">
                                            <!-- Danh sách phí sẽ được append vào đây -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>{{ __('Từ') }}</label>
                                            <select id="state-1" class="form-control" onchange="caculateFee()">
                                                <option value="1">{{ __('Hà Nội') }}</option>
                                                <option value="1">{{ __('HCM') }}</option>
                                                <option value="2">{{ __('Tỉnh Khác') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>{{ __('Sang') }}</label>
                                            <select id="state-2" class="form-control" onchange="caculateFee()">
                                                <option value="1">{{ __('Hà Nội') }}</option>
                                                <option value="1">{{ __('HCM') }}</option>
                                                <option value="2">{{ __('Tỉnh Khác') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="form-group">
                                <h5>{{ __('Tổng Phí : ') }} <span id="total-fee"></span></h5>
                            </div>
                            <p class="text-center" style="color:red; font-size: 12px">{{ __('* Kết Quả Bên Trên Chỉ Mang Tính Chất Tham Khảo ') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 style="color: #1089ff">{{ __('Ước Tính Lãi Suất Mua Trả Góp') }}</h5>
                            <form id="feeForm">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span>{{ __('Giá Xe') }}</span>
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #01d28e; color: #FFFFFF"><i class="fa fa-tag"></i></span>
                                                </div>
                                                <input type="text" class="form-control" onchange="caculateBank()" id="price-total" disabled aria-label="" value="{{ $product->price }}" placeholder="{{ $product->price }}" aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <span>{{ __('Trả Trước (Triệu)') }}</span>
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #01d28e; color: #FFFFFF"><i class="fa fa-tag"></i></span>
                                                </div>
                                                <input type="text" class="form-control" onchange="caculateBank()" id="prepay" aria-label="" value="{{ number_format((int) str_replace(['.', ' VNĐ'], '', $product->price) / 2, 0, ',', '.') . ' VNĐ' }}" aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span>{{ __('Lãi Suất (% Năm)') }}</span>
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #01d28e; color: #FFFFFF"><i class="fa fa-piggy-bank"></i></span>
                                                </div>
                                                <input type="text" onchange="caculateBank()" class="form-control" id="interest-rate" aria-label="" value="8" aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <span>{{ __('Thời Hạn (Tháng)') }}</span>
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: #01d28e; color: #FFFFFF"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <select class="form-control" id="duration" onchange="caculateBank()">
                                                    <option value="12">12</option>
                                                    <option value="24">24</option>
                                                    <option value="48">48</option>
                                                    <option value="60" selected>60</option>
                                                    <option value="96">96</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="form-group">
                                <h5>{{ __('Số Tiền Trả Hàng Tháng : ') }} <span id="total-bank"></span></h5>
                                <h6>{{ __('Số Tiền Gốc Trả Hàng Tháng : ') }} <span id="total-origin"></span></h6>
                                <h6>{{ __('Số Tiền Lãi Trả Hàng Tháng : ') }} <span id="total-interest"></span></h6>
                            </div>
                            <p class="text-center" style="color:red; font-size: 12px">{{ __('* Số Tiền Trả Hàng Tháng Sẽ Giảm Dần Theo Dư Nợ Gốc Từng Năm. Kết Quả Bên Trên Chỉ Mang Tính Chất Tham Khảo ') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(count($relateProduct) > 0)
            <section class="ftco-section ftco-no-pt" style="padding: 20px !important">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                            <h2 class="mb-2">{{ __('Xe Cùng Phân Khúc') }}</h2>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($relateProduct as $item)
                            <div class="col-md-3">
                                <a href="{{ route('product.detail', ['id' => $item->id]) }}">
                                    <div class="car-wrap rounded ftco-animate">
                                        <div class="img rounded d-flex align-items-end"
                                             style="background-image: url({{ asset($item->thumbnail) }});">
                                        </div>
                                        <div class="text">
                                            <h2 class="mb-0 product-title">
                                                {{ $item->name }}
                                            </h2>
                                            <div class="mb-3">
                                                <span class="cat">{{ $item->producer->name }}</span>
                                                <p class="price">{{ $item->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if(count($relateProductByProducer) > 0)
            <section class="ftco-section" style="padding: 20px !important">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                            <h2 class="mb-2">{{ __('Có Thể Bạn Quan Tâm') }}</h2>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($relateProductByProducer as $item)
                            <div class="col-md-3">
                                <a href="{{ route('product.detail', ['id' => $item->id]) }}">
                                    <div class="car-wrap rounded ftco-animate">
                                        <div class="img rounded d-flex align-items-end"
                                             style="background-image: url({{ asset($item->thumbnail) }});">
                                        </div>
                                        <div class="text">
                                            <h2 class="mb-0 product-title">
                                                {{ $item->name }}
                                            </h2>
                                            <div class="mb-3">
                                                <span class="cat">{{ $item->producer->name }}</span>
                                                <p class="price">{{ $item->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </section>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-thumbnail modal-dialog modal-lg" role="document">
            <span class="close-icon" data-dismiss="modal" aria-label="Close">&times;</span>
            <div class="modal-content">
                <div class="modal-body">
                    <div id="modalCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#modalCarousel" data-slide-to="0" class="active"></li>
                            @foreach($gallery as $index => $image)
                                @if($image)
                                    <li data-target="#modalCarousel" data-slide-to="{{ $index + 1 }}"></li>
                                @endif
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100 zoomable" src="{{ asset($product->thumbnail) }}" alt="First slide">
                            </div>
                            @foreach($gallery as $image)
                                @if($image)
                                    <div class="carousel-item">
                                        <img class="d-block w-100 zoomable" src="{{ asset($image) }}" alt="Slide">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#modalCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#modalCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const zoomableImages = document.querySelectorAll('.zoomable');
            let scale = 1;
            let isDragging = false;
            let startX, startY;
            let currentX = 0;
            let currentY = 0;
            const dragSensitivity = 1; // Tăng độ nhạy kéo
            const maxScale = 3; // Tỷ lệ zoom tối đa

            zoomableImages.forEach((img) => {
                img.addEventListener('dblclick', () => {
                    scale = scale === 1 ? maxScale : 1; // Toggle giữa zoom 1x và tỷ lệ zoom tối đa
                    resetPosition(img); // Đặt lại vị trí khi zoom
                    updateTransform(img);
                });

                img.addEventListener('dragstart', (e) => {
                    e.preventDefault();
                });

                img.addEventListener('mousedown', (e) => {
                    if (e.button === 0) {
                        isDragging = true;
                        startX = e.pageX - currentX;
                        startY = e.pageY - currentY;
                        img.style.cursor = 'grabbing';
                    }
                });

                img.addEventListener('mouseleave', () => {
                    isDragging = false;
                    img.style.cursor = scale === 1 ? 'grab' : 'zoom-out';
                });

                img.addEventListener('mouseup', () => {
                    isDragging = false;
                    img.style.cursor = scale === 1 ? 'grab' : 'zoom-out';
                });

                img.addEventListener('mousemove', (e) => {
                    if (!isDragging) return;

                    e.preventDefault();
                    const x = e.pageX;
                    const y = e.pageY;
                    currentX = (x - startX) * dragSensitivity; // Áp dụng độ nhạy kéo
                    currentY = (y - startY) * dragSensitivity; // Áp dụng độ nhạy kéo

                    limitDrag(img); // Giới hạn kéo
                    updateTransform(img);
                });

                // Cập nhật vị trí và zoom của ảnh
                function updateTransform(image) {
                    image.style.transform = `translate(${currentX}px, ${currentY}px) scale(${scale})`;
                }

                function limitDrag(image) {
                    const rect = image.getBoundingClientRect();
                    const parentRect = image.parentElement.getBoundingClientRect(); // Kích thước container chứa ảnh

                    // Giới hạn kéo ngang
                    const maxX = (rect.width * scale - parentRect.width) / 2; // Tính khoảng cách tối đa có thể kéo
                    currentX = Math.max(Math.min(currentX, maxX), -maxX);

                    // Giới hạn kéo dọc
                    const maxY = (rect.height * scale - parentRect.height) / 2; // Tính khoảng cách tối đa có thể kéo
                    currentY = Math.max(Math.min(currentY, maxY), -maxY);
                }

                // Reset lại trạng thái ảnh
                const resetPosition = () => {
                    currentX = 0;
                    currentY = 0;
                    limitDrag(img); // Đảm bảo ảnh không bị kéo quá
                    updateTransform(img);
                };

                // Khi load ảnh mới, reset lại zoom và vị trí
                img.addEventListener('load', () => {
                    scale = 1; // Reset lại zoom
                    resetPosition(); // Đặt lại vị trí ảnh
                    img.style.cursor = 'grab'; // Đặt lại con trỏ chuột
                });

                // Touch events cho thiết bị di động
                let initialDistance = null;

                img.addEventListener('touchstart', (e) => {
                    if (e.touches.length === 2) {
                        initialDistance = getDistance(e.touches);
                        e.preventDefault();
                    }
                });

                img.addEventListener('touchmove', (e) => {
                    if (e.touches.length === 2 && initialDistance) {
                        const currentDistance = getDistance(e.touches);
                        scale = (currentDistance / initialDistance); // Tính tỷ lệ zoom
                        scale = Math.min(scale, maxScale); // Giới hạn tỷ lệ zoom tối đa
                        updateTransform(img);
                        e.preventDefault();
                    }
                });

                img.addEventListener('touchend', () => {
                    initialDistance = null;
                });
            });

            function getDistance(touches) {
                const dx = touches[0].clientX - touches[1].clientX;
                const dy = touches[0].clientY - touches[1].clientY;
                return Math.sqrt(dx * dx + dy * dy);
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#productCarousel .carousel-item img').on('click', function () {
                var index = $(this).parent().index(); // Lấy chỉ số của item hiện tại
                $('#imageModal').modal('show');
                $('#modalCarousel').carousel(index);
            });

            // script.js
            $(document).ready(function() {
                var $image = $('#zoom-image');
                var $lens = $('#zoom-lens');
                var $result = $('#zoom-result');

                // Set size for lens and result
                var lensSize = 100;
                var resultSize = 300;

                $lens.css({
                    width: lensSize + 'px',
                    height: lensSize + 'px',
                    borderRadius: '50%'
                });

                $result.css({
                    width: resultSize + 'px',
                    height: resultSize + 'px',
                    backgroundImage: 'url(' + $image.attr('src') + ')',
                    backgroundSize: $image.width() * (resultSize / lensSize) + 'px ' + $image.height() * (resultSize / lensSize) + 'px'
                });

                // Mousemove event handler
                $image.mousemove(function(e) {
                    var imageOffset = $image.offset();
                    var x = e.pageX - imageOffset.left;
                    var y = e.pageY - imageOffset.top;

                    // Calculate lens position
                    var lensX = x - $lens.width() / 2;
                    var lensY = y - $lens.height() / 2;

                    // Ensure lens is within image bounds
                    if (lensX < 0) lensX = 0;
                    if (lensY < 0) lensY = 0;
                    if (lensX > $image.width() - $lens.width()) lensX = $image.width() - $lens.width();
                    if (lensY > $image.height() - $lens.height()) lensY = $image.height() - $lens.height();

                    $lens.css({
                        left: lensX + 'px',
                        top: lensY + 'px'
                    });

                    // Calculate result image position
                    var resultX = lensX * (resultSize / lensSize);
                    var resultY = lensY * (resultSize / lensSize);

                    $result.css({
                        backgroundPosition: '-' + resultX + 'px -' + resultY + 'px'
                    });
                });

                // Hide lens and result on mouseleave
                $image.mouseleave(function() {
                    $lens.hide();
                    $result.hide();
                });

                // Show lens and result on mouseenter
                $image.mouseenter(function() {
                    $lens.show();
                    $result.show();
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function submitForm() {
            const name = $('#name-info').val(); // Lấy giá trị từ input Tên
            const phone = $('#phone-info').val(); // Lấy giá trị từ input Số điện thoại
            const product_id = {{ $product->id }}; // Lấy giá trị từ product_id

            // Bắt đầu xác thực dữ liệu
            let isValid = true;

            // Xác thực trường name (Không được để trống và ít nhất 3 ký tự)
            if (name.trim() === '' || name.length < 3) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lỗi!',
                    text: 'Vui lòng nhập tên hợp lệ (ít nhất 3 ký tự).',
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#ff5b5b'
                });
                isValid = false;
            }

            // Xác thực trường phone (Chỉ chứa số và có 10 ký tự)
            const phoneRegex = /^[0-9]{10}$/; // Chỉ cho phép 10 số
            if (!phoneRegex.test(phone)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Lỗi!',
                    text: 'Vui lòng nhập số điện thoại hợp lệ (10 số).',
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#ff5b5b'
                });
                isValid = false;
            }

            // Nếu tất cả các trường đều hợp lệ, tiến hành gửi dữ liệu
            if (isValid) {
                $.ajax({
                    url: '{{ route('api.contact-request') }}', // URL của route mà bạn đã định nghĩa
                    type: 'POST',
                    data: {
                        name: name,
                        phone: phone,
                        product_id: product_id,
                        _token: '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng
                    },
                    success: function(response) {
                        // Hiển thị thông báo thành công với SweetAlert2
                        Swal.fire({
                            icon: 'success',
                            title: 'Gửi thành công!',
                            text: 'Thông tin của bạn đã được gửi thành công.',
                            confirmButtonText: 'Đóng',
                            confirmButtonColor: '#01d28e'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#myModal').modal('hide'); // Đóng modal sau khi người dùng bấm 'Đóng'
                            }
                        });
                    },
                    error: function(xhr) {
                        // Thông báo lỗi nếu có
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Đã xảy ra lỗi: ' + xhr.responseJSON.message,
                            confirmButtonText: 'Đóng',
                            confirmButtonColor: '#ff5b5b'
                        });
                    }
                });
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            caculateFee();
            caculateBank();
        });

        function caculateFee() {
            // Gửi dữ liệu qua Ajax nếu cần
            var state1 = $('#state-1').val();
            var state2 = $('#state-2').val();
            var fee1 = $('#fee_2').is(':checked') ? $('#fee_2').val() : null;
            var fee2 = $('#fee_3').is(':checked') ? $('#fee_3').val() : null;
            var fee3 = $('#fee_4').is(':checked') ? $('#fee_4').val() : null;
            $.ajax({
                url: '{{ route('api.calculate-fee') }}',
                method: 'POST',
                data: {
                    product_id: {{ $product->id }},
                    state1: state1,
                    state2: state2,
                    fee1: fee1,
                    fee2: fee2,
                    fee3: fee3,
                },
                success: function(response) {
                    $('#feeListContainer').empty(); // Xóa nội dung cũ
                    $('#total-fee').empty(); // Xóa tổng cũ

                    response.feeList.forEach(function(item) {
                        // Kiểm tra xem item.id có phải là fee1, fee2 hoặc fee3 không
                        let isChecked = (response.fee1 == item.id || response.fee2 == item.id || response.fee3 == item.id);

                        // Thêm checkbox và hiển thị phí
                        $('#feeListContainer').append(`
                            <input type="checkbox" value="${item.id}" id="fee_${item.id}"
                                ${item.fee_mode != 0 ? 'disabled checked' : ''} ${isChecked ? 'checked' : ''}
                                onchange="caculateFee()"/>
                                ${item.fee_type} - ${item.fee_value}<br>
                            `);
                        });

                    // Cập nhật tổng phí
                    $('#total-fee').append(response.total);
                }
            });
        }

        function caculateBank() {
            // Gửi dữ liệu qua Ajax nếu cần
            var priceTotal = $('#price-total').val();
            var prepay = $('#prepay').val();
            var interestRate = $('#interest-rate').val();
            var duration = $('#duration').val();
            $.ajax({
                url: '{{ route('api.calculate-bank') }}',
                method: 'POST',
                data: {
                    priceTotal: priceTotal,
                    prepay: prepay,
                    interestRate: interestRate,
                    duration: duration,
                },
                success: function(response) {
                    $('#total-bank').empty(); // Xóa tổng cũ
                    $('#total-origin').empty(); // Xóa tổng cũ
                    $('#total-interest').empty(); // Xóa tổng cũ

                    // Cập nhật tổng phí
                    $('#total-bank').append(response.total);
                    $('#total-origin').append(response.origin);
                    $('#total-interest').append(response.interest);
                }
            });
        }

        function formatCurrencyVND(number) {
            return number.toLocaleString('vi-VN') + " VNĐ";
        }

        $('#prepay').on('input', function() {
            let inputVal = $(this).val();

            // Xóa ký hiệu tiền tệ và dấu phân cách
            let numericValue = inputVal.replace(/[^0-9]/g, '');

            if (numericValue.length > 0) {
                // Lấy vị trí con trỏ hiện tại
                let cursorPosition = this.selectionStart;

                // Định dạng giá trị
                let formattedValue = formatCurrencyVND(Number(numericValue));

                // Gán giá trị đã định dạng vào input
                $(this).val(formattedValue);

                // Đặt lại vị trí con trỏ
                this.setSelectionRange(cursorPosition, cursorPosition);
            } else {
                $(this).val('');
            }
        });

        $('#prepay').on('focus', function() {
            let inputVal = $(this).val();
            let numericValue = inputVal.replace(/[^0-9]/g, '');

            if (numericValue.length > 0) {
                $(this).val(numericValue);
            }
        });

        $('#prepay').on('blur', function() {
            let inputVal = $(this).val();
            let numericValue = inputVal.replace(/[^0-9]/g, '');

            if (numericValue.length > 0) {
                let formattedValue = formatCurrencyVND(Number(numericValue));
                $(this).val(formattedValue);
            } else {
                $(this).val('');
            }
        });
    </script>
@stop
