<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    const accessToken = '{{ session('jwt_token') }}';
    $("#add-classify-post-form").submit(function (e) {
        e.preventDefault();
        var form = $("#add-classify-post-form");
        var file_data = $('#classify-logo').prop('files')[0];
        var name_data = $('#classify-name').val();
        $('#classify-name').css('border', '1px solid #ebedf2');
        $('#msg-classify-name').empty();

        $('#logo-require').css('background', '#ffff');
        $('#msg-logo-classify').empty();

        if (name_data === '') {
            $('#classify-name').css('border', '1px solid red');
            $('#msg-classify-name').append("{{ trans('Tên không được để trống') }}");
            return;
        }

        if (!file_data) {
            $('#logo-require').css('background', '#f59b9b9e')
            $('#msg-logo-classify').append("{{ trans('Logo không được để trống') }}");
            return;
        }

        var form_data = new FormData();
        form_data.append('name', name_data);
        form_data.append('logo', file_data);

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            headers: {
                'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
            },
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
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

    function EditUser (id, name, email, roles, rolesTarget) {
        var listRoles = JSON.parse(roles);
        const content = document.createElement('div');
        content.className = 'custom-content';
        content.style.textAlign = 'left';

        const divInputElm1 = document.createElement('div');
        divInputElm1.className = 'form-group form-group-default';

        const selectElm = document.createElement('select');
        selectElm.className = 'form-select';
        selectElm.id = 'rolesEditSelect';

        const labelSelectElm = document.createElement('label');
        labelSelectElm.textContent = "{{ trans('Chọn Chức Vụ') }}";
        for (var i = 0; i < listRoles.length; i++) {
            const optionElm = document.createElement('option');
            optionElm.value = listRoles[i].id;
            optionElm.textContent = listRoles[i].name;
            if (listRoles[i].id == rolesTarget) {
                optionElm.selected = true;
            }
            selectElm.appendChild(optionElm);
        }

        divInputElm1.appendChild(labelSelectElm);
        divInputElm1.appendChild(selectElm);

        const divInputElm2 = document.createElement('div');
        divInputElm2.className = 'form-group form-group-default';

        const labelInputElm2 = document.createElement('label');
        labelInputElm2.textContent = "{{ trans('Tên') }}";

        const inputElm2 = document.createElement('input');
        inputElm2.className = 'form-control';
        inputElm2.id = 'name-edit';
        inputElm2.type =  'text';
        inputElm2.value =  name;

        const divInputElm3 = document.createElement('div');
        divInputElm3.className = 'form-group form-group-default';

        const labelInputElm3 = document.createElement('label');
        labelInputElm3.textContent = "{{ trans('Email') }}";

        const inputElm3 = document.createElement('input');
        inputElm3.className = 'form-control';
        inputElm3.id = 'email-edit';
        inputElm3.type =  'text';
        inputElm3.value =  email;

        divInputElm2.appendChild(labelInputElm2);
        divInputElm2.appendChild(inputElm2);

        divInputElm3.appendChild(labelInputElm3);
        divInputElm3.appendChild(inputElm3);

        content.appendChild(divInputElm1);
        content.appendChild(divInputElm2);
        content.appendChild(divInputElm3);

        swal({
            title: "{{ trans('Sửa Thông Tin Người Dùng') }}",
            content: content,
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
            var roleIdData = $("#rolesEditSelect").val();
            var nameData = $("#name-edit").val();
            var emailData = $("#email-edit").val();
            if (Submit && nameData || Submit && emailData) {
                $.ajax({
                    url: "{{ route('api.user-update') }}",
                    type: "POST",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken,
                    },
                    data: {
                        id: id,
                        name: nameData,
                        roles_id: roleIdData,
                        email: emailData
                    } ,
                    success: function (response) {
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

    function DeleteUser (id) {
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
                $.ajax({
                    url: "{{ route('api.user-delete') }}",
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
