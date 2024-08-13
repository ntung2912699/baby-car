@extends('client.layout.client_layout')

@section('content')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>

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
        .modal-dialog {
            max-width: 100%; /* Điều chỉnh kích thước modal cho các thiết bị di động */
            /*margin: 5vh auto; !* Thêm khoảng cách từ đầu màn hình cho thiết bị di động *!*/
            padding-top: 80px;
        }

        .modal-content {
            border-radius: 0;
        }

        .modal-body {
            padding: 0;
            position: relative;
            overflow: hidden; /* Đảm bảo rằng các phần tử không bị tràn ra ngoài */
        }

        .modal-body img {
            width: 100%;
            height: auto;
            cursor: pointer;
            transition: transform 0.3s ease;
            touch-action: none; /* Vô hiệu hóa các hành động chạm mặc định */
        }

        .close-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 2rem;
            color: #fff;
            cursor: pointer;
            z-index: 1050;
        }

        .modal-content img.zoomed {
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
    </style>

    <section class="ftco-section ftco-car-details">
        <div class="container" style="border-bottom: 2px solid #dedede">
            <div class="row">
                <div class="col-12">
                    <div class="text text-center">
                        <span class="subheading">{{ $product->producer->name }}</span>
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
                                <li data-target="#productCarousel" data-slide-to="{{ $index + 1 }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ $product->thumbnail }}" alt="First slide">
                            </div>
                            @foreach($gallery as $image)
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ $image }}" alt="Slide">
                                </div>
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
                </div>
                <!-- Chi tiết xe -->
                <div class="col-md-6">
                    <div class="car-details-text">
                        <div class="row">
                            @foreach($attributeByProduct as $attr)
                                <div class="col-md-6">
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
            </div>
        </div>
        @if(count($relateProduct) > 0)
            <section class="ftco-section ftco-no-pt" style="padding-top: 20px">
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
                                             style="background-image: url({{ $item->thumbnail }});">
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <span class="close-icon" data-dismiss="modal" aria-label="Close">&times;</span>
                    <div id="modalCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#modalCarousel" data-slide-to="0" class="active"></li>
                            @foreach($gallery as $index => $image)
                                <li data-target="#modalCarousel" data-slide-to="{{ $index + 1 }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ $product->thumbnail }}" alt="First slide">
                            </div>
                            @foreach($gallery as $image)
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ $image }}" alt="Slide">
                                </div>
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
        $(document).ready(function () {
            $('#productCarousel .carousel-item img').on('click', function () {
                var index = $(this).parent().index(); // Lấy chỉ số của item hiện tại
                $('#imageModal').modal('show');
                $('#modalCarousel').carousel(index);
            });

            // Xử lý zoom trên thiết bị di động
            $('.modal-body img').on('dblclick', function () {
                $(this).toggleClass('zoomed');
            });

            // Đảm bảo zoom hoạt động trên các thiết bị di động
            $('.modal-body img').on('touchstart', function () {
                var $this = $(this);
                if ($this.hasClass('zoomed')) {
                    $this.removeClass('zoomed');
                } else {
                    $this.addClass('zoomed');
                }
            });
        });
    </script>
@stop
