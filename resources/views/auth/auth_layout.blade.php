<!DOCTYPE html>
<html lang="en">
<!-- Head -->
@include('admin.layout_admin.component_layout.head')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<body>
    <div class="container">
        <div class="page-inner">
            <!-- Content -->
            @yield('content')
        </div>
    </div>
    @include('admin.layout_admin.component_layout.script_import')
</body>
</html>
