<style>
    /* CSS cho modal tìm kiếm */
    .modal-content {
        border-radius: 10px; /* Bo tròn góc của modal */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Thêm bóng đổ cho modal */
        border: none; /* Xóa viền mặc định của modal */
    }

    .modal-header {
        border-bottom: none; /* Xóa đường viền dưới header của modal */
        padding: 20px; /* Thêm khoảng cách bên trong header của modal */
    }

    .modal-title {
        font-size: 1.5rem; /* Tăng kích thước font của tiêu đề modal */
        font-weight: bold; /* Làm cho tiêu đề đậm */
    }

    .close {
        font-size: 1.5rem; /* Tăng kích thước biểu tượng đóng */
        color: #333; /* Màu của biểu tượng đóng */
        opacity: 0.7; /* Độ mờ của biểu tượng đóng */
    }

    .close:hover {
        color: #000; /* Màu của biểu tượng đóng khi di chuột qua */
        opacity: 1; /* Độ mờ của biểu tượng đóng khi di chuột qua */
    }

    .modal-body {
        padding: 20px; /* Thêm khoảng cách bên trong body của modal */
    }

    .form-control {
        border-radius: 5px; /* Bo tròn góc của ô nhập liệu */
        border: 1px solid #ddd; /* Đặt màu viền của ô nhập liệu */
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); /* Thêm bóng đổ bên trong ô nhập liệu */
    }

    .btn-primary {
        background-color: #007bff; /* Màu nền của nút tìm kiếm */
        border-color: #007bff; /* Màu viền của nút tìm kiếm */
        border-radius: 5px; /* Bo tròn góc của nút tìm kiếm */
        padding: 10px 20px; /* Thêm khoảng cách bên trong nút tìm kiếm */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Màu nền của nút khi di chuột qua */
        border-color: #004085; /* Màu viền của nút khi di chuột qua */
    }

</style>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Nice<span>Car</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">{{ __('Trang Chủ') }}</a></li>
                <li class="nav-item"><a href="{{ url('/#') }}" class="nav-link">{{ __('Về Chúng Tôi') }}</a></li>
                <li class="nav-item"><a href="{{ url('/#') }}" class="nav-link">{{ __('Dịch Vụ') }}</a></li>
                <li class="nav-item"><a href="{{ route('product.list') }}" class="nav-link">{{ __('Tìm Xe') }}</a></li>
                <li class="nav-item"><a href="{{ url('/#') }}" class="nav-link">{{ __('Liên Hệ') }}</a></li>

                <!-- Biểu tượng tìm kiếm -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#searchModal">
                        <i class="fas fa-search"></i> <!-- Biểu tượng tìm kiếm -->
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Xin chào, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            @if(Auth::user()->roles_id != 1)
                                <a class="dropdown-item" href="{{ route('admin.index') }}">{{ 'Trang Quản Trị' }}</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng Xuất</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link btn" style="background-color: #01d28e; color: #FFFFFF">Đăng Nhập</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Popup Tìm Kiếm -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">{{ __('Tìm Kiếm Xe Của Bạn') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('search') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="Nhập từ khóa tìm kiếm...">
                        <div class="input-group-append">
                            <button class="btn btn-search" style="background-color: #01d28e" type="submit">
                                <i class="fas fa-search"></i> <!-- Biểu tượng tìm kiếm -->
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

