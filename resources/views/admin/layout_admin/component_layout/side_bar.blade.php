<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.index') }}" class="logo">
                <img
                    src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20"
                />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-home"></i>
                        <p>{{ trans('Trang Chủ Người Dùng') }}</p>
                    </a>
                </li>
                <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                    <h4 class="text-section">{{ trans('Các Danh Mục') }}</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>{{ trans('Quản Lý') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('category.index') }}">
                                    <span class="sub-item">{{ trans('Kiểu Dáng Xe') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('producer.index') }}">
                                    <span class="sub-item">{{ trans('Hãng Xe') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('attribute.index') }}">
                                    <span class="sub-item">{{ trans('Options Xe') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('status.index') }}">
                                    <span class="sub-item">{{ trans('Trạng Thái Xe') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('product.index') }}">
                                    <span class="sub-item">{{ trans('Sản Phẩm') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.index') }}">
                                    <span class="sub-item">{{ trans('Tài Khoản') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-store"></i>
                        <p>{{ trans('Marketing') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">{{ trans('Facebook') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">{{ trans('Tiktok') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">{{ trans('Youtobe') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">{{ trans('Google') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#forms">
                        <i class="fas fa-cogs"></i>
                        <p>{{ trans('Cài Đặt') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Basic Form</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-coins"></i>
                        <p>{{ trans('Dịch Vụ') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#maps">
                        <i class="fas fa-info-circle"></i>
                        <p>{{ trans('Thông Tin') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/googlemaps.html">
                                    <span class="sub-item">Google Maps</span>
                                </a>
                            </li>
                            <li>
                                <a href="maps/jsvectormap.html">
                                    <span class="sub-item">Jsvectormap</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- End Sidebar -->
