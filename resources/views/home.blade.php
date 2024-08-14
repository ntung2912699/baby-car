@extends('client.layout.client_layout')

@section('content')
    <style>
        .product-title {
            white-space: nowrap; /* Ngăn không cho văn bản xuống dòng */
            overflow: hidden; /* Ẩn phần văn bản bị tràn ra ngoài */
            text-overflow: ellipsis; /* Thêm dấu chấm ba để chỉ ra rằng văn bản đã bị cắt */
        }

        @media (max-width: 768px) {
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
        }

    </style>
    <section class="hero-wrap hero-wrap-2 js-fullheight"
             style="background-image: url('{{asset('assets/client/images/bg_3.jpg')}}');"
             data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">{{ __('Trang Chủ  ') }}<i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>{{ __('Xe  ') }}<i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">{{ __('Hãy Chọn Chiếc Xe Của Bạn') }}</h1>
                </div>
            </div>
        </div>
    </section>
{{ var_dump(session('jwt_token')) }}
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <h2 class="mb-2">{{ __('Các Hãng Xe') }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-car owl-carousel">
                        @foreach($producers as $producer)
                            <a href="{{ route('product.by-producer', ['id' => $producer->id]) }}">
                                <div class="item">
                                    <div class="testimony-wrap rounded text-center py-3 pb-4">
                                        <div class="user-img mb-2" style="background-image: url({{ $producer->logo }})">
                                        </div>
                                        <div class="text pt-4">
                                            <p class="name">{{ $producer->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <h2 class="mb-2">{{ __('Xe Mới Về') }}</h2>
                </div>
            </div>
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
            <div class="row mt-5">
                {{ $products->links('client.vendor.pagination.custom_panigation') }}
            </div>
        </div>
    </section>


    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-3">{{ __('Các Dịch Vụ Cung Cấp') }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">{{ __('Hỗ Trợ Bank 70% Giá Trị Xe') }}</h3>
                            <p>{{ __('Hỗ Trợ Khách Hàng Trả Góp Lên Đến 70% Giá Tri Xe, Với Thủ Tục Nhanh Gọn Và An Toàn') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">{{ __('Giao Xe Tận Nơi') }}</h3>
                            <p>{{ __('Chúng Tôi Có Dịch Vụ Giao Xe Tận Nơi Cho Bạn Ở Mọi Tỉnh Thành Cả Nước') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">{{ __('Bảo Hành') }}</h3>
                            <p>{{ __('Dịch Vụ Bảo Hành Tới 3 Năm / 60.000km Dành Cho Xe Của Cửa Hàng Bán Ra') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">{{ __('Thu Cũ Đổi Mới') }}</h3>
                            <p>{{ __('Sẵn Sàng Hỗ Trợ Thu Cũ Đổi Mới Với Giá Cả Hợp Lý Nếu Như Khách Hàng Có Nhu Cầu') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-counter ftco-section img bg-light" id="section-counter">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="10">0</strong>
                            <span>{{ __('Năm') }} <br>{{ __('Kinh Nghiệm') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="{{ $countProduct }}">0</strong>
                            <span>{{ __('Tổng Số') }} <br>{{ 'Xe' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="{{ $countProductSold }}">0</strong>
                            <span>{{ __('Xe') }} <br>{{ __('Đã Bán') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="{{ $countUser }}">0</strong>
                            <span>{{ __('Khách Hàng') }} <br>{{ __('Đánh Giá Cao Dịch Vụ') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
