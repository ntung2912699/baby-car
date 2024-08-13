<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    const accessToken = '{{ session('jwt_token') }}';
    $("#add-model-post-form").submit(function (e) {
        e.preventDefault();
        var form = $("#add-model-post-form");
        var producer_id_data = $('#producerSelect').val();
        var name_data = $('#model-name').val();
        $('#model-name').css('border', '1px solid #ebedf2');
        $('#msg-model-name').empty();

        if (name_data === '') {
            $('#model-name').css('border', '1px solid red');
            $('#msg-model-name').append("{{ trans('Tên không được để trống') }}");
            return;
        }

        var form_data = new FormData();
        form_data.append('producer_id', producer_id_data);
        form_data.append('name', name_data);

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

    function EditModel (id, name, producers, requestID) {
        const content = document.createElement('div');
        content.className = 'custom-content';
        content.style.textAlign = 'left';

        const divInputElm1 = document.createElement('div');
        divInputElm1.className = 'form-group form-group-default';

        const selectElm = document.createElement('select');
        selectElm.className = 'form-select';
        selectElm.id = 'producerEditSelect';

        const labelSelectElm = document.createElement('label');
        labelSelectElm.textContent = "{{ trans('Chọn Hãng Xe') }}";

        for (var i = 0; i < producers.length; i++) {
            const optionElm = document.createElement('option');
            optionElm.value = producers[i].id;
            optionElm.textContent = producers[i].name;
            if (producers[i].id === requestID) {
                optionElm.selected = true;
            }
            selectElm.appendChild(optionElm);
        }

        divInputElm1.appendChild(labelSelectElm);
        divInputElm1.appendChild(selectElm);

        const divInputElm2 = document.createElement('div');
        divInputElm2.className = 'form-group form-group-default';

        const labelInputElm = document.createElement('label');
        labelInputElm.textContent = "{{ trans('Tên Dòng Xe') }}";

        const inputElm = document.createElement('input');
        inputElm.className = 'form-control';
        inputElm.id = 'model-name-edit';
        inputElm.type =  'text';
        inputElm.value =  name;

        divInputElm2.appendChild(labelInputElm);
        divInputElm2.appendChild(inputElm);

        content.appendChild(divInputElm1);
        content.appendChild(divInputElm2);

        swal({
            title: "{{ trans('Sửa Dòng Xe') }}",
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
            var producerIdData = $("#producerEditSelect").val();
            var nameData = $("#model-name-edit").val();
            if (Submit && producerIdData || Submit && nameData) {
                $.ajax({
                    url: "{{ route('model.update') }}",
                    type: "POST",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken,
                    },
                    data: {
                        id: id,
                        producer_id: producerIdData,
                        name: nameData
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

    function DeleteModel (id) {
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
                    url: "{{ route('model.delete') }}",
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

    $(document).ready(function(){
        $('.closeModal').click(function(){
            $('#addRowModal').modal('hide');
        });
    });
</script>
