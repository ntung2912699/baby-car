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

    <!-- Custom template | don't include it in your project! -->
{{--    @include('admin.layout_admin.component_layout.custom_template')--}}
    <!-- End Custom template -->
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
    });
</script>
</body>
</html>
