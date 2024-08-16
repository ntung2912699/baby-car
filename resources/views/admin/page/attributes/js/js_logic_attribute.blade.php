<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    const accessToken = '{{ session('jwt_token') }}';
    $("#add-option-post-form").submit(function (e) {
        e.preventDefault();
        var form = $("#add-option-post-form");
        var name_data = $('#attribute-name').val();
        $('#attribute-name').css('border', '1px solid #ebedf2');
        $('#msg-attribute-name').empty();

        if (name_data === '') {
            $('#attribute-name').css('border', '1px solid red');
            $('#msg-attribute-name').append("{{ trans('Tên không được để trống') }}");
            return;
        }

        var form_data = new FormData();
        form_data.append('name', name_data);
        var loadingElement = document.getElementById('loading');
        // Hiển thị thông báo loading
        loadingElement.style.display = 'block';
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            headers: {
                'Authorization': 'Bearer ' + accessToken,
            },
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                loadingElement.style.display = 'none';
                swal("{{ trans('Success') }}!", "{{ trans('Thành Công !') }}", {
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: "btn btn-success",
                        },
                    },
                });
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function(response) {
                loadingElement.style.display = 'none';
                swal("{{ trans('Error') }}!", response.responseJSON.message, {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: "btn btn-danger",
                        },
                    },
                });
            },
        });
    });

    function EditAttribute (id, name) {
        swal({
            title: "{{ trans('Sửa Tên Option') }}",
            html: '<br><input class="form-control" placeholder="{{ trans('Nhập Tên Mới') }}" id="input-field-name name="attribute_name" value="'+ name +'">',
            content: {
                element: "input",
                attributes: {
                    placeholder: "{{ trans('Nhập Tên Mới') }}",
                    type: "text",
                    id: "input-field",
                    className: "form-control",
                    value: name
                },
            },
            buttons: {
                confirm: {
                    text: "{{ trans('Gửi') }}",
                    className: "btn btn-primary",
                    id: "confirm-btn"
                },
                cancel: {
                    text: "{{ trans('Hủy') }}",
                    visible: true,
                    className: "btn btn-secondary",
                },
            },
        }).then((Submit) => {
            var nameData = $("#input-field").val();
            if (Submit && nameData) {
                var loadingElement = document.getElementById('loading');
                // Hiển thị thông báo loading
                loadingElement.style.display = 'block';
                $.ajax({
                    url: "{{ asset('api/admin/attribute/update') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
                    },
                    data: {
                        id: id,
                        name: nameData
                    } ,
                    success: function (response) {
                        loadingElement.style.display = 'none';
                        swal("{{ trans('Success') }}!", "{{ trans('Thành Công !') }}", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                    className: "btn btn-success",
                                },
                            },
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    },
                    error: function(response) {
                        loadingElement.style.display = 'none';
                        swal("{{ trans('Error') }}!", response.responseJSON.message, {
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: "btn btn-danger",
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

    function DeleteAttribute (id) {
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
                    className: "btn btn-secondary",
                },
            },
        }).then((Delete) => {
            if (Delete) {
                var loadingElement = document.getElementById('loading');
                // Hiển thị thông báo loading
                loadingElement.style.display = 'block';
                $.ajax({
                    url: "{{ asset('api/admin/attribute/delete') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
                    },
                    data: {
                        id: id,
                    } ,
                    success: function (response) {
                        loadingElement.style.display = 'none';
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
                        loadingElement.style.display = 'none';
                        swal("{{ trans('Error!') }}!", response.responseJSON.message, {
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: "btn btn-danger",
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

    $(document).ready(function(){
        $('.closeModal').click(function(){
            $('#addRowModal').modal('hide');
        });
    });
</script>
