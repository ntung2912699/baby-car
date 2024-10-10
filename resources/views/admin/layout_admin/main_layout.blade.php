<!DOCTYPE html>
<html lang="en">
<!-- Head -->
@include('admin.layout_admin.component_layout.head')
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<body>
<div class="wrapper">
    <!-- Sidebar -->
    @include('admin.layout_admin.component_layout.side_bar')
    <!-- End Sidebar -->

    <div class="main-panel">
        <!-- Header -->
        @include('admin.layout_admin.component_layout.header')

        <div class="container">
            <div class="page-inner">
                <!-- Content -->
                @yield('content')
            </div>
        </div>
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <img id="modalImg" class="modal-img" src="">
            </div>
        </div>
        <!-- Footer -->
        @include('admin.layout_admin.component_layout.footer')
    </div>
    <form method="POST" id="logout-form" action="{{ route('logout') }}">
        @csrf
    </form>

    <!-- Custom template | don't include it in your project! -->
{{--    @include('admin.layout_admin.component_layout.custom_template')--}}
    <!-- End Custom template -->
</div>
<style>
    /* Thông báo loading */
    #loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Nền tối để làm nổi bật thông báo loading */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1050; /* Đảm bảo thông báo loading nằm trên các phần tử khác */
    }

    .loading-overlay {
        text-align: center;
    }

    .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.4em;
        border-color: rgba(255, 255, 255, 0.7) transparent rgba(255, 255, 255, 0.7) transparent;
    }
</style>
<!-- Thông báo loading -->
<div id="loading" style="display: none;">
    <div class="loading-overlay" style="padding-top: 20%">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<!--   Core JS Files   -->
@include('admin.layout_admin.component_layout.script_import')
<script>
    $(document).ready(function() {
        const currentUrl = window.location.pathname;
        const baseURL = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
        const urlTarget = baseURL + currentUrl;
        const targetLink = $('a[href="' + urlTarget + '"]');
        if (targetLink.length) {
            targetLink.parent().addClass('active');
            targetLink.parents('.collapse').addClass('show');
            targetLink.parents('.nav-item').find('a').attr('aria-expanded', 'true');
        } else {
            const parts = currentUrl.split('/');

            // Lấy các phần cần thiết và nối lại
            const baseUrl = parts.slice(0, 3).join('/');
            // Tìm tất cả các thẻ <a> trong .sidebar-content có thuộc tính href chứa "admin/product"
            const linkFind = $('.sidebar-content a[href*="'+ baseUrl +'"]');

            // Ví dụ: Nếu bạn muốn xử lý các thẻ <a> tìm được, bạn có thể lặp qua chúng
            linkFind.each(function() {
                const link = $(this);
                // Xử lý link ở đây, ví dụ: thêm lớp 'active'
                $(link).parent().addClass('active');

                // Mở rộng menu chứa link nếu có
                const parentNavItem = link.closest('.nav-item');
                parentNavItem.addClass('active');

                // Kiểm tra và mở rộng menu con chứa link
                const parentCollapse = link.closest('.collapse');
                if (parentCollapse.length) {
                    parentCollapse.addClass('show');
                    parentNavItem.find('a').attr('aria-expanded', 'true');
                }
            });
        }

        const accessToken = '{{ session('jwt_token') }}';

        if (accessToken) {
            $.ajax({
                url: "{{ route('api.session-check') }}",
                type: "POST",
                headers: {
                    'Authorization': 'Bearer ' + accessToken  // Thêm token vào header Authorization
                },
                cache: false,
                dataType: 'json',
                success: function (response) {
                    if(response.status === 'success'){
                        {{--// Token hợp lệ, tiếp tục truy cập--}}
                        {{--swal("{{ trans('Success') }}!", response.message, {--}}
                        {{--    icon: "success",--}}
                        {{--    buttons: {--}}
                        {{--        confirm: {--}}
                        {{--            className: "btn btn-success",--}}
                        {{--        },--}}
                        {{--    },--}}
                        {{--});--}}
                    } else {
                        // Token hết hạn hoặc không hợp lệ, logout
                        swal("{{ trans('Error') }}!", response.message, {
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: "btn btn-danger",
                                },
                            },
                        }).then((OK) => {
                            $('#logout-form').submit();
                        });
                    }
                },
                error: function(error) {
                    swal("{{ trans('Error') }}!", "Token không hợp lệ hoặc đã hết hạn.", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: "btn btn-danger",
                            },
                        },
                    }).then((OK) => {
                        $('#logout-form').submit();
                    });
                }
            });
        } else {
            // Nếu không có token, người dùng sẽ bị logout
            swal("{{ trans('Error') }}!", "Không tìm thấy Token xác thực. Vui lòng đăng nhập và thử lại", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: "btn btn-danger",
                    },
                },
            }).then((OK) => {
                $('#logout-form').submit();
            });
        }
    });
</script>
</body>
</html>
