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

            ackground-color:
        }

        @media (min-width: 769px) {
            .modal-dialog {
                max-width: 60%; /* Kích thước modal cho các thiết bị PC */
                margin: auto; /* Đảm bảo modal nằm ở giữa màn hình */
            }
        }
    </style>

    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-4">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="border w-100 p-4 rounded mb-2 d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-map-o"></span>
                                </div>
                                <p><span>Address:</span> Khu CNC Hoà Lạc, Thạch Thất, Hà Nội</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border w-100 p-4 rounded mb-2 d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-mobile-phone"></span>
                                </div>
                                <p><span>Phone:</span> <a href="tel://1234567920">+84 3629 12699</a></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border w-100 p-4 rounded mb-2 d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-envelope-o"></span>
                                </div>
                                <p><span>Email:</span> <a href="mailto:otonavy@gmail.com"></a>otonavy@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 block-9 mb-md-5">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.68060334584!2d105.53770827540785!3d21.01463098826347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345b005b086701%3A0xabec891cb0c67f98!2sFPT%20F-Ville%203!5e1!3m2!1svi!2s!4v1723620362371!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@stop
