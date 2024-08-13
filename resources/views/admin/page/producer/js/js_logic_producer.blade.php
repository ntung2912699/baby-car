<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    const accessToken = '{{ session('jwt_token') }}';
    $("#add-producer-post-form").submit(function (e) {
        e.preventDefault();
        var form = $("#add-producer-post-form");
        var file_data = $('#producer-logo').prop('files')[0];
        var name_data = $('#producer-name').val();
        $('#producer-name').css('border', '1px solid #ebedf2');
        $('#msg-producer-name').empty();

        $('#logo-require').css('background', '#ffff');
        $('#msg-logo-producer').empty();

        if (name_data === '') {
            $('#producer-name').css('border', '1px solid red');
            $('#msg-producer-name').append("{{ trans('Tên không được để trống') }}");
            return;
        }

        if (!file_data) {
            $('#logo-require').css('background', '#f59b9b9e')
            $('#msg-logo-producer').append("{{ trans('Logo không được để trống') }}");
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

    function EditProducer (id, name) {
        swal({
            title: "{{ trans('Sửa Tên Hãng Xe') }}",
            html: '<br><input class="form-control" placeholder="{{ trans('Nhập Tên Mới') }}" id="input-field-name name="producer_name" value="'+ name +'">',
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
                $.ajax({
                    url: "{{ asset('api/admin/producer/update_name') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
                    },
                    data: {
                        id: id,
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

    function EditProducerLogo (id, file) {
        const content = document.createElement('div');
        content.className = 'custom-content';

        // const imgDiv = document.createElement('div');
        // imgDiv.className = 'avatar avatar-xxl';


        const iconElm = document.createElement('i');
        iconElm.className = 'fas fa-file-upload';
        iconElm.style.fontSize = '50px';
        iconElm.style.color = 'black';

        const divIcon = document.createElement('div');
        divIcon.className = 'overlay-icon';
        divIcon.style.position = 'absolute';
        divIcon.style.top = '50%';
        divIcon.style.left = '50%';
        divIcon.style.transform = 'translate(-50%, -50%)';
        divIcon.style.opacity = '0';
        divIcon.style.transition = 'opacity 0.3s ease';
        divIcon.addEventListener('mouseover', function() {
            img.style.opacity = '0.5';
            divIcon.style.opacity = '1';
        });

        divIcon.appendChild(iconElm);

        const img = document.createElement('img');
        img.className = 'avatar-img rounded-circle';
        img.id = 'outputLogoEdit';
        img.src = file;
        img.alt = '...';
        img.addEventListener('mouseover', function() {
            img.style.opacity = '0.5';
            divIcon.style.opacity = '1';
        });
        img.addEventListener('mouseout', function() {
            img.style.opacity = '1';
            divIcon.style.opacity = '0';
        });

        // imgDiv.appendChild(img);

        const inputDiv = document.createElement('div');
        inputDiv.className = 'form-group';

        const label = document.createElement('label');
        label.setAttribute('for', 'upload-field');
        label.appendChild(img);
        label.appendChild(divIcon);

        const input = document.createElement('input');
        input.type = 'file';
        input.setAttribute('hidden', 'hidden');
        input.onchange = function () {
            var outputLogoEdit = document.getElementById('outputLogoEdit');
            outputLogoEdit.src = URL.createObjectURL(event.target.files[0]);
            outputLogoEdit.onload = function() {
                URL.revokeObjectURL(outputLogoEdit.src) // free memory
            }
            img.style.opacity = '1';
            divIcon.style.opacity = '0';
        };
        input.name = 'logo';
        input.id = 'upload-field';
        input.accept = 'image/*';
        input.class = 'form-control-file';

        inputDiv.appendChild(label);
        inputDiv.appendChild(input);

        // content.appendChild(imgDiv);
        content.appendChild(inputDiv);

        swal({
            title: "{{ trans('Sửa Logo Hãng Xe') }}",
            content: content,
            buttons: {
                confirm: {
                    className: "btn btn-primary",
                    id: "confirm-btn"
                },
                cancel: {
                    visible: true,
                    className: "btn btn-secondary",
                },
            },
        }).then((Submit) => {
            var file_data = $('#upload-field').prop('files')[0];
            if (Submit && file_data) {
                var form_data = new FormData();
                form_data.append('id', id);
                form_data.append('logo', file_data);
                $.ajax({
                    url: "{{ asset('api/admin/producer/update_logo') }}",
                    type: "post",
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
                    }
                });
            } else {
                swal.close();
            }
        });
    }

    function DeleteProducer (id) {
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
                    url: "{{ asset('api/admin/producer/delete') }}",
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

    var loadFile = function(event) {
        var output = document.getElementById('output-logo');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
        var iconUpload = document.getElementById('image-upload-icon')
        iconUpload.addEventListener('mouseover', function() {
            output.style.opacity = '0.5';
            iconUpload.style.opacity = '1';
        });
        output.addEventListener('mouseover', function() {
            output.style.opacity = '0.5';
            iconUpload.style.opacity = '1';
        });
        output.addEventListener('mouseout', function() {
            output.style.opacity = '1';
            iconUpload.style.opacity = '0';
        });
        var elmOutput = document.getElementById('preview-image');
        elmOutput.removeAttribute('hidden');
        var elmLable = document.getElementById('image-upload');
        elmLable.setAttribute('hidden', 'hidden');
        $('#logo-require').css('background', '#ffff');
        $('#msg-logo-producer').empty();
    };

    function clearForm() {
        $('#add-producer-post-form input').val('');
        var elmOutput = document.getElementById('preview-image');
        elmOutput.setAttribute('hidden', 'hidden');
        var elmLable = document.getElementById('image-upload');
        elmLable.removeAttribute('hidden');
    }
</script>
