<!DOCTYPE html>
<html lang="en">
@include('client.layout.component_layout.head')
<body>

@include('client.layout.component_layout.header')
<!-- END nav -->

@include('client.layout.component_layout.nav')

@yield('content')

@include('client.layout.component_layout.footer')

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
@include('client.layout.component_layout.script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
@auth
    $(document).ready(function() {
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
                        // Token hợp lệ, tiếp tục truy cập
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
        }
    });
@endauth
</script>
</body>
</html>
