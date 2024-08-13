<script>
    const accessToken = '{{ session('jwt_token') }}';

    function DeleteProduct (id) {
        swal({
            title: "{{ trans('Bạn Chắc Chắn Chứ') }}?",
            text: "{{ trans('Nếu xác nhận bạn sẽ không thể khôi phục lại dữ liệu mà bạn đã xóa') }}!",
            type: "warning",
            buttons: {
                confirm: {
                    text: "{{ trans('Xác Nhận Xóa') }}",
                    className: "btn btn-primary",
                },
                cancel: {
                    text: "{{ trans('Hủy') }}",
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((Delete) => {
            if (Delete) {
                $.ajax({
                    url: "{{ route('api.product-delete') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
                    },
                    data: {
                        id: id,
                    } ,
                    success: function (response) {
                        swal("{{ trans('Deleted!') }}!", "{{ trans('Thành Công !') }}", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                    className: "btn btn-success",
                                },
                            },
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(response) {
                        swal("{{ trans('Error!') }}!", response.responseJSON.message, {
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: "btn btn-error",
                                },
                            },
                        });
                    }
                });
            } else {
                swal.close();
            }
        });
    }
</script>
