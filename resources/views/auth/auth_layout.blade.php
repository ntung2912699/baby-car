<!DOCTYPE html>
<html lang="en">
<!-- Head -->
@include('admin.layout_admin.component_layout.head')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<style>
    .form-control:focus {
        border-color: #01d28e;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
</style>
<body>
    <div class="text-left">
        <a class="btn btn-link" style="color:#01d28e;" href="{{ url('/') }}">
            {{ __('Về Trang Chủ') }}
        </a>
    </div>
    <div class="container">
        <div class="page-inner">
            <!-- Content -->
            @yield('content')
        </div>
    </div>
    @include('admin.layout_admin.component_layout.script_import')
</body>
</html>
