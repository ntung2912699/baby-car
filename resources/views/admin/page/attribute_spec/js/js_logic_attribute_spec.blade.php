<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    const accessToken = '{{ session('jwt_token') }}';
    $("#add-spec-post-form").submit(function (e) {
        e.preventDefault();

        var form = $("#add-spec-post-form");
        var option_id_data = $('#optionSelect').val();
        var value_data = $('#attribute-spec-value').val();
        $('#attribute-spec-value').css('border', '1px solid #ebedf2');
        $('#msg-attribute-spec-value').empty();

        if (value_data === '') {
            $('#attribute-spec-value').css('border', '1px solid red');
            $('#msg-attribute-spec-value').append("{{ trans('Tên không được để trống') }}");
            return;
        }

        var form_data = new FormData();
        form_data.append('attribute_id', option_id_data);
        form_data.append('value', value_data);

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
                // Ẩn thông báo loading và hiển thị modal
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
                // Ẩn thông báo loading và hiển thị modal
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

    function EditAttributeSpec (id, value, attributes, requestID) {
        const content = document.createElement('div');
        content.className = 'custom-content';
        content.style.textAlign = 'left';

        const divInputElm1 = document.createElement('div');
        divInputElm1.className = 'form-group form-group-default';

        const selectElm = document.createElement('select');
        selectElm.className = 'form-select';
        selectElm.id = 'optionEditSelect';

        const labelSelectElm = document.createElement('label');
        labelSelectElm.textContent = "{{ trans('Chọn Option') }}";

        for (var i = 0; i < attributes.length; i++) {
            const optionElm = document.createElement('option');
            optionElm.value = attributes[i].id;
            optionElm.textContent = attributes[i].name;
            if (attributes[i].id === requestID) {
                optionElm.selected = true;
            }
            selectElm.appendChild(optionElm);
        }

        divInputElm1.appendChild(labelSelectElm);
        divInputElm1.appendChild(selectElm);

        const divInputElm2 = document.createElement('div');
        divInputElm2.className = 'form-group form-group-default';

        const labelInputElm = document.createElement('label');
        labelInputElm.textContent = "{{ trans('Giá Trị Option') }}";

        const inputElm = document.createElement('input');
        inputElm.className = 'form-control';
        inputElm.id = 'attribute-spec-value-edit';
        inputElm.type =  'text';
        inputElm.value =  value;

        divInputElm2.appendChild(labelInputElm);
        divInputElm2.appendChild(inputElm);

        content.appendChild(divInputElm1);
        content.appendChild(divInputElm2);

        swal({
            title: "{{ trans('Sửa Tính Năng Option') }}",
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
            var attrIdData = $("#optionEditSelect").val();
            var valueData = $("#attribute-spec-value-edit").val();
            if (Submit && attrIdData || Submit && valueData) {
                var loadingElement = document.getElementById('loading');
                // Hiển thị thông báo loading
                loadingElement.style.display = 'block';
                $.ajax({
                    url: "{{ asset('api/admin/spec/update') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken,
                    },
                    data: {
                        id: id,
                        attribute_id: attrIdData,
                        value: valueData
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

    function DeleteAttributeSpec (id) {
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
                    url: "{{ asset('api/admin/spec/delete') }}",
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

    $(document).ready(function(){
        $('.closeModal').click(function(){
            $('#addRowModal').modal('hide');
        });
    });
</script>
