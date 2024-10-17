<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    const accessToken = '{{ session('jwt_token') }}';

    $("#add-product-post-form").submit(function (e) {
        e.preventDefault();
        var form = $("#add-product-post-form");
        var statusData = $('input[name="status-id"]:checked').val();
        var categoryData = $('#categorySelect').val();
        var producerData = $('#producerSelect').val();
        var modelData = $('#modelSelect').val();
        var nameData = $('#name').val();
        var priceData = $('#price').val();
        var cost_priceData = $('#cost_price').val();
        var thumbnailData = $('#thumbnail-upload').prop('files')[0];
        var galleryData = $('#gallery-upload').prop('files');
        var descriptionData = $('#description').val();
        var specIdArr = [];
        var listSpecInputChecked = $('input.spec-input:checked');
        listSpecInputChecked.map(function(index, elm) {
            specIdArr.push($(elm).val());
        })

        $('#status-form span').css('border', '1px solid #ebedf2');
        $('#msg-status').empty();

        if (!statusData) {
            $('#status-form span').css('border', '1px solid red');
            $('#msg-status').append("{{ trans('Trạng thái không được để trống') }}");
            return;
        }

        $('#categorySelectContent').css('border', '1px solid #ebedf2');
        $('#msg-categorySelect').empty();

        if (!categoryData || categoryData === '---') {
            $('#categorySelectContent').css('border', '1px solid red');
            $('#msg-categorySelect').append("{{ trans('Kiểu dáng không được để trống') }}");
            return;
        }

        $('#producerSelectContent').css('border', '1px solid #ebedf2');
        $('#msg-producerSelect').empty();

        if (!producerData || producerData === '---') {
            $('#producerSelectContent').css('border', '1px solid red');
            $('#msg-producerSelect').append("{{ trans('Hãng sản xuất không được để trống') }}");
            return;
        }

        $('#modelSelectContent').css('border', '1px solid #ebedf2');
        $('#msg-modelSelect').empty();

        if (!modelData || modelData === '---') {
            $('#modelSelectContent').css('border', '1px solid red');
            $('#msg-modelSelect').append("{{ trans('Dòng Xe không được để trống') }}");
            return;
        }

        $('#name').css('border', '1px solid #ebedf2');
        $('#msg-name').empty();

        if (!nameData) {
            $('#name').css('border', '1px solid red');
            $('#msg-name').append("{{ trans('Tên không được để trống') }}");
            return;
        }

        $('#price').css('border', '1px solid #ebedf2');
        $('#msg-price').empty();

        if (!priceData) {
            $('#price').css('border', '1px solid red');
            $('#msg-price').append("{{ trans('Giá không được để trống') }}");
            return;
        }

        $('#cost_price').css('border', '1px solid #ebedf2');
        $('#msg-cost_price').empty();

        if (!cost_priceData) {
            $('#cost_price').css('border', '1px solid red');
            $('#msg-cost_price').append("{{ trans('Giá Nhập không được để trống') }}");
            return;
        }

        $('#thumbnail-require').css('border', '1px solid #ebedf2');
        $('#msg-thumbnail').empty();

        if (!thumbnailData) {
            $('#thumbnail-require').css('border', '1px solid red');
            $('#msg-thumbnail').append("{{ trans('Ảnh chính không được để trống') }}");
            return;
        }

        $('#gallery-require').css('border', '1px solid #ebedf2');
        $('#msg-gallery').empty();

        if (!galleryData || galleryData.length === 0) {
            $('#gallery-require').css('border', '1px solid red');
            $('#msg-gallery').append("{{ trans('Ảnh phụ không được để trống') }}");
            return;
        }

        $('#description').css('border', '1px solid #ebedf2');
        $('#msg-description').empty();

        if (!descriptionData) {
            $('#description').css('border', '1px solid red');
            $('#msg-description').append("{{ trans('Mô tả không được để trống') }}");
            return;
        }

        var form_data = new FormData();
        form_data.append('category_id', categoryData);
        form_data.append('producer_id', producerData);
        form_data.append('model_id', modelData);
        form_data.append('status_id', statusData);
        form_data.append('name', nameData);
        form_data.append('price', priceData);
        form_data.append('cost_price', cost_priceData);
        form_data.append('thumbnail', thumbnailData);
        for (var i = 0; i < galleryData.length; i++) {
            form_data.append('gallery[]', galleryData[i]);
        }
        form_data.append('description', descriptionData);
        form_data.append('spec', specIdArr);

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

    var loadFile = function(event) {
        var output = document.getElementById('output-thumbnail');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
        var iconUpload = document.getElementById('thumbnail-image-icon')
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
        var elmLable = document.getElementById('thumbnail-image-upload');
        elmLable.setAttribute('hidden', 'hidden');
        $('#thumbnail-require').css('background', '#ffff');
        $('#msg-thumbnail').empty();
    };

    $(document).ready(function() {
        var loadingElement = document.getElementById('loading');
        // Hiển thị thông báo loading
        loadingElement.style.display = 'block';
        $.ajax({
            url: "{{ route('api.get-attribute') }}",
            type: "GET",
            headers: {
                'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
            },
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                loadingElement.style.display = 'none';
                const data = response.data;
                if (data.attributes) {
                    buildAttributeForm(data.attributes);
                }
                if (data.status) {
                    buildStatusForm(data.status);
                }
                if (data.categories) {
                    buildCategoryForm(data.categories);
                }
                if (data.producers) {
                    buildProducerForm(data.producers);
                }
            },
            error: function(response) {
                loadingElement.style.display = 'none';
                swal("{{ trans('Error') }}!", "{{ __('Tải Tính Năng Sản Phẩm Thất Bại, Vui Lòng Thử Lại') }}", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: "btn btn-danger",
                        },
                    },
                });
            }
        });
    });

    function producerChange() {
        var producerId = $(this).val();
        if (producerId) {
            var loadingElement = document.getElementById('loading');
            // Hiển thị thông báo loading
            loadingElement.style.display = 'block';
            var url = '{{ route("model.get-by-producer", ["producerId" => "__producerId__"]) }}';
            url = url.replace('__producerId__', producerId);
            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
                },
                cache: false,
                success: function(data) {
                    loadingElement.style.display = 'none';
                    $('#modelSelectContent').removeAttr('hidden');
                    buildModelForm(data.data.models, data.data.producers, producerId)
                },
                error: function(response) {
                    loadingElement.style.display = 'none';
                    $('#modelSelectContent').attr('hidden','hidden');
                    swal("{{ trans('Error') }}!", "{{ __('Tải Dòng Xe Thất Bại, Vui Lòng Thử Lại') }}", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: "btn btn-danger",
                            },
                        },
                    });
                }
            });
        }
    };

    function buildAttributeForm(data) {
        const attributes = data;

        const mainContentAttr = $('#attribute-form');
        mainContentAttr.empty();

        const contentAttr = document.createElement('div');

        for (var i = 0; i < attributes.length; i++) {
            const attr_id_target = attributes[i].id;
            const attr_name_target = attributes[i].name;
            const itemAttr = document.createElement('div');
            itemAttr.className = 'form-group';

            const itemAttrLabel = document.createElement('label');
            itemAttrLabel.className = 'form-label';
            itemAttrLabel.textContent = attributes[i].name;

            const brAttr = document.createElement('br');

            const divSpec = document.createElement('div');
            divSpec.className = 'selectgroup selectgroup-pills';

            for (var j = 0; j < attributes[i].spec.length; j++) {
                const labelSpec = document.createElement('label');
                labelSpec.className = 'selectgroup-item';

                const inputRadioSpec = document.createElement('input');
                inputRadioSpec.className = 'selectgroup-input spec-input';
                inputRadioSpec.type = 'radio';
                inputRadioSpec.name = 'spec-id-'+ attributes[i].id;
                inputRadioSpec.value = attributes[i].spec[j].id;
                inputRadioSpec.id = 'spec-input-' + attributes[i].spec[j].id;

                const spanSpec = document.createElement('span');
                spanSpec.className = 'selectgroup-button';
                spanSpec.textContent = attributes[i].spec[j].value

                labelSpec.appendChild(inputRadioSpec);
                labelSpec.appendChild(spanSpec);

                divSpec.appendChild(labelSpec);
            }

            const btnAddSpec = document.createElement('label');
            btnAddSpec.className = 'selectgroup-item';
            btnAddSpec.onclick = function() {
                CreateSpec.call(this, attr_id_target, attr_name_target);
            };

            const spanAddSpec = document.createElement('span');
            spanAddSpec.className = 'selectgroup-button';

            const iconAddSpec = document.createElement('i');
            iconAddSpec.className = 'fas fa-plus';

            spanAddSpec.appendChild(iconAddSpec);
            btnAddSpec.appendChild(spanAddSpec);

            divSpec.appendChild(btnAddSpec);

            itemAttr.appendChild(itemAttrLabel);
            itemAttr.appendChild(brAttr);
            itemAttr.appendChild(divSpec);

            contentAttr.appendChild(itemAttr);
        }
        mainContentAttr.append(contentAttr);
    }

    function buildStatusForm (data) {
        const mainContentStatus = $('#status-form');
        mainContentStatus.empty();

        const divStatusContent = document.createElement('div');
        divStatusContent.className = 'selectgroup selectgroup-secondary selectgroup-pills';

        for (var i = 0; i < data.length; i++) {
            const labelStatus = document.createElement('label');
            labelStatus.className = 'selectgroup-item';

            const inputRadioStatus = document.createElement('input');
            inputRadioStatus.className = 'selectgroup-input';
            inputRadioStatus.type = 'radio';
            inputRadioStatus.name = 'status-id';
            inputRadioStatus.value = data[i].id;
            inputRadioStatus.id = 'spec-input';

            const spanStatus = document.createElement('span');
            spanStatus.className = 'selectgroup-button';
            spanStatus.textContent = data[i].name

            labelStatus.appendChild(inputRadioStatus);
            labelStatus.appendChild(spanStatus);

            divStatusContent.appendChild(labelStatus);
        }
        const btnAddStatus = document.createElement('label');
        btnAddStatus.className = 'selectgroup-item';
        btnAddStatus.onclick = CreateStatus;

        const spanAddStatus = document.createElement('span');
        spanAddStatus.className = 'selectgroup-button';

        const iconAddStatus = document.createElement('i');
        iconAddStatus.className = 'fas fa-plus';

        spanAddStatus.appendChild(iconAddStatus);
        btnAddStatus.appendChild(spanAddStatus);

        divStatusContent.appendChild(btnAddStatus);

        mainContentStatus.append(divStatusContent);
    }

    function buildCategoryForm (data) {
        const mainContentSelectCategory = $('#categorySelectContent');
        mainContentSelectCategory.empty();

        const divContent = document.createElement('div');

        const labelSelect = document.createElement('label');
        labelSelect.textContent = '{{ __('Chọn Kiểu Dáng ') }}';

        const spanRequire = document.createElement('span');
        spanRequire.textContent = "*"
        spanRequire.style.color = "red";

        labelSelect.appendChild(spanRequire);

        const iconAddCategory = document.createElement('i');
        iconAddCategory.className = 'fas fa-plus-circle';
        iconAddCategory.style.fontSize = '15px';
        iconAddCategory.onclick = CreateCategory;

        labelSelect.appendChild(iconAddCategory);

        const selectCategoryInput = document.createElement('select');
        selectCategoryInput.className = 'form-select';
        selectCategoryInput.id = 'categorySelect';
        selectCategoryInput.name = 'category_id';

        const optionNone = document.createElement('option');
        optionNone.textContent = '---';

        selectCategoryInput.appendChild(optionNone);

        for (var i = 0; i < data.length; i++) {
            const option = document.createElement('option');
            option.value = data[i].id;
            option.textContent = data[i].name
            selectCategoryInput.appendChild(option);
        }
        divContent.appendChild(labelSelect);
        divContent.appendChild(selectCategoryInput);
        mainContentSelectCategory.append(divContent);
    }

    function buildProducerForm (data) {
        const mainContentSelectProducer = $('#producerSelectContent');
        mainContentSelectProducer.empty();

        const divContent = document.createElement('div');

        const labelSelect = document.createElement('label');
        labelSelect.textContent = '{{ __('Chọn Hãng Xe ') }}';

        const spanRequire = document.createElement('span');
        spanRequire.textContent = "*"
        spanRequire.style.color = "red";

        labelSelect.appendChild(spanRequire);

        const iconAddProducer = document.createElement('i');
        iconAddProducer.className = 'fas fa-plus-circle';
        iconAddProducer.style.fontSize = '15px';
        iconAddProducer.onclick = ProducerCreate;

        labelSelect.appendChild(iconAddProducer);

        const selectProducerInput = document.createElement('select');
        selectProducerInput.className = 'form-select';
        selectProducerInput.id = 'producerSelect';
        selectProducerInput.name = 'producer_id';
        selectProducerInput.onchange = producerChange

        const optionNone = document.createElement('option');
        optionNone.textContent = '---';

        selectProducerInput.appendChild(optionNone);

        for (var i = 0; i < data.length; i++) {
            const option = document.createElement('option');
            option.value = data[i].id;
            option.textContent = data[i].name
            selectProducerInput.appendChild(option);
        }
        divContent.appendChild(labelSelect);
        divContent.appendChild(selectProducerInput);
        mainContentSelectProducer.append(divContent);
    }

    function buildModelForm(data, producers, producerId) {
        const mainContentSelectModel = $('#modelSelectContent');
        mainContentSelectModel.empty();

        const divContent = document.createElement('div');

        const labelSelect = document.createElement('label');
        labelSelect.textContent = '{{ __('Chọn Dòng Xe ') }}';

        const spanRequire = document.createElement('span');
        spanRequire.textContent = "*";
        spanRequire.style.color = "red";

        labelSelect.appendChild(spanRequire);

        const iconAddModel = document.createElement('i');
        iconAddModel.className = 'fas fa-plus-circle';
        iconAddModel.style.fontSize = '15px';

        // Thay vì gán hàm ModelCreate(producers) trực tiếp, tạo một hàm ẩn danh
        iconAddModel.onclick = function() {
            ModelCreate(producers, producerId);
        };

        labelSelect.appendChild(iconAddModel);

        const selectModelInput = document.createElement('select');
        selectModelInput.className = 'form-select';
        selectModelInput.id = 'modelSelect';
        selectModelInput.name = 'model_id';

        const optionNone = document.createElement('option');
        optionNone.textContent = '---';

        selectModelInput.appendChild(optionNone);

        for (var i = 0; i < data.length; i++) {
            const option = document.createElement('option');
            option.value = data[i].id;
            option.textContent = data[i].name;
            selectModelInput.appendChild(option);
        }

        divContent.appendChild(labelSelect);
        divContent.appendChild(selectModelInput);
        mainContentSelectModel.append(divContent);
    }


    function CreateStatus () {
        swal({
            title: "{{ trans('Thêm Mới Trạng Thái') }}",
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
                    className: "btn btn-danger",
                },
            },
        }).then((Submit) => {
            var nameData = $("#input-field").val();
            if (Submit && nameData) {
                var loadingElement = document.getElementById('loading');
                // Hiển thị thông báo loading
                loadingElement.style.display = 'block';
                $.ajax({
                    url: "{{ route('status.store') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
                    },
                    data: {
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
                        buildStatusForm(response.data);
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

    function CreateCategory () {
        const content = document.createElement('div');
        content.className = 'custom-content';
        content.style.textAlign = 'left';

        const labelTextLogo = document.createElement('label');
        labelTextLogo.textContent =  '{{ __('Logo') }}';
        content.appendChild(labelTextLogo);

        const iconElm = document.createElement('i');
        iconElm.className = 'fas fa-file-upload';
        iconElm.style.fontSize = '50px';
        iconElm.style.color = 'black';

        const divIcon = document.createElement('div');
        divIcon.className = 'overlay-icon';
        divIcon.style.position = 'absolute';
        divIcon.style.top = '40%';
        divIcon.style.left = '50%';
        divIcon.style.transform = 'translate(-50%, -50%)';
        divIcon.style.opacity = '1';
        divIcon.style.transition = 'opacity 0.3s ease';
        divIcon.addEventListener('mouseover', function() {
            img.style.opacity = '0.5';
            divIcon.style.opacity = '1';
        });

        divIcon.appendChild(iconElm);

        const img = document.createElement('img');
        img.className = 'avatar-img rounded-circle';
        img.id = 'outputLogoEdit';
        img.src = '';
        img.alt = '...';
        img.hidden = 'hidden';
        img.addEventListener('mouseover', function() {
            img.style.opacity = '0.5';
            divIcon.style.opacity = '1';
        });
        img.addEventListener('mouseout', function() {
            img.style.opacity = '1';
            divIcon.style.opacity = '0';
        });

        const inputDiv1 = document.createElement('div');
        inputDiv1.className = 'form-group';
        inputDiv1.style.border = '2px solid #ebedf2';
        inputDiv1.style.minHeight = '250px';

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
            outputLogoEdit.removeAttribute('hidden');
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

        inputDiv1.appendChild(label);
        inputDiv1.appendChild(input);

        const inputDiv2 = document.createElement('div');
        inputDiv2.className = 'form-group';

        const label2 = document.createElement('label');
        label2.textContent = '{{ __('Tên Kiểu Dáng') }}';

        const input2 = document.createElement('input');
        input2.type = 'text';
        input2.className = 'form-control';
        input2.id = 'name-category';
        input2.name = 'name';

        inputDiv2.appendChild(label2);
        inputDiv2.appendChild(input2);

        content.appendChild(inputDiv1);
        content.appendChild(inputDiv2);

        swal({
            title: "{{ trans('Thêm Mới Kiểu Dáng') }}",
            content: content,
            buttons: {
                confirm: {
                    className: "btn btn-primary",
                    id: "confirm-btn"
                },
                cancel: {
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((Submit) => {
            var file_data = $('#upload-field').prop('files')[0];
            var name_data = $('#name-category').val();
            if (Submit && file_data) {
                var loadingElement = document.getElementById('loading');
                // Hiển thị thông báo loading
                loadingElement.style.display = 'block';
                var form_data = new FormData();
                form_data.append('logo', file_data);
                form_data.append('name', name_data);
                $.ajax({
                    url: "{{ route('category.store') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
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
                        buildCategoryForm(response.data);
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

    function ProducerCreate () {
        const content = document.createElement('div');
        content.className = 'custom-content';
        content.style.textAlign = 'left';

        const labelTextLogo = document.createElement('label');
        labelTextLogo.textContent =  '{{ __('Logo') }}';
        content.appendChild(labelTextLogo);

        const iconElm = document.createElement('i');
        iconElm.className = 'fas fa-file-upload';
        iconElm.style.fontSize = '50px';
        iconElm.style.color = 'black';

        const divIcon = document.createElement('div');
        divIcon.className = 'overlay-icon';
        divIcon.style.position = 'absolute';
        divIcon.style.top = '40%';
        divIcon.style.left = '50%';
        divIcon.style.transform = 'translate(-50%, -50%)';
        divIcon.style.opacity = '1';
        divIcon.style.transition = 'opacity 0.3s ease';
        divIcon.addEventListener('mouseover', function() {
            img.style.opacity = '0.5';
            divIcon.style.opacity = '1';
        });

        divIcon.appendChild(iconElm);

        const img = document.createElement('img');
        img.className = 'avatar-img rounded-circle';
        img.id = 'outputLogoEdit';
        img.src = '';
        img.alt = '...';
        img.hidden = 'hidden';
        img.addEventListener('mouseover', function() {
            img.style.opacity = '0.5';
            divIcon.style.opacity = '1';
        });
        img.addEventListener('mouseout', function() {
            img.style.opacity = '1';
            divIcon.style.opacity = '0';
        });

        const inputDiv1 = document.createElement('div');
        inputDiv1.className = 'form-group';
        inputDiv1.style.border = '2px solid #ebedf2';
        inputDiv1.style.minHeight = '250px';

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
            outputLogoEdit.removeAttribute('hidden');
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

        inputDiv1.appendChild(label);
        inputDiv1.appendChild(input);

        const inputDiv2 = document.createElement('div');
        inputDiv2.className = 'form-group';

        const label2 = document.createElement('label');
        label2.textContent = '{{ __('Tên Hãng Xe') }}';

        const input2 = document.createElement('input');
        input2.type = 'text';
        input2.className = 'form-control';
        input2.id = 'name-producer';
        input2.name = 'name';

        inputDiv2.appendChild(label2);
        inputDiv2.appendChild(input2);

        content.appendChild(inputDiv1);
        content.appendChild(inputDiv2);

        swal({
            title: "{{ trans('Thêm Mới Hãng Xe') }}",
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
            var name_data = $('#name-producer').val();
            if (Submit && file_data) {
                var loadingElement = document.getElementById('loading');
                // Hiển thị thông báo loading
                loadingElement.style.display = 'block';
                var form_data = new FormData();
                form_data.append('logo', file_data);
                form_data.append('name', name_data);
                $.ajax({
                    url: "{{ route('producer.store') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
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
                        buildProducerForm(response.data);
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

    function ModelCreate (producers, producerId) {
        const content = document.createElement('div');
        content.className = 'custom-content';
        content.style.textAlign = 'left';

        const inputDiv1 = document.createElement('div');
        inputDiv1.className = 'form-group';

        const selectElm = document.createElement('select');
        selectElm.className = 'form-select';
        selectElm.id = 'producer-id';

        const labelSelectElm = document.createElement('label');
        labelSelectElm.textContent = "{{ trans('Chọn Hãng Xe') }}";

        for (var i = 0; i < producers.length; i++) {
            const optionElm = document.createElement('option');
            optionElm.value = producers[i].id;
            optionElm.textContent = producers[i].name;
            selectElm.appendChild(optionElm);
            if (producerId == producers[i].id) {
                optionElm.selected = 'selected';
                selectElm.disabled = 'disabled';
            }
        }

        inputDiv1.appendChild(labelSelectElm);
        inputDiv1.appendChild(selectElm);

        const inputDiv2 = document.createElement('div');
        inputDiv2.className = 'form-group';

        const label2 = document.createElement('label');
        label2.textContent = '{{ __('Tên Dòng Xe') }}';

        const input2 = document.createElement('input');
        input2.type = 'text';
        input2.className = 'form-control';
        input2.id = 'name-model';
        input2.name = 'name';

        inputDiv2.appendChild(label2);
        inputDiv2.appendChild(input2);

        content.appendChild(inputDiv1);
        content.appendChild(inputDiv2);

        swal({
            title: "{{ trans('Thêm Mới Dòng') }}",
            content: content,
            buttons: {
                confirm: {
                    className: "btn btn-primary",
                    id: "confirm-btn"
                },
                cancel: {
                    visible: true,
                    className: "btn btn-danger",
                },
            },
        }).then((Submit) => {
            var producer_data = $('#producer-id').val();
            var name_data = $('#name-model').val();
            if (Submit && producer_data) {
                var loadingElement = document.getElementById('loading');
                // Hiển thị thông báo loading
                loadingElement.style.display = 'block';
                var form_data = new FormData();
                form_data.append('producer_id', producer_data);
                form_data.append('name', name_data);
                $.ajax({
                    url: "{{ route('model.store') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
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
                        buildModelForm(response.data.models,response.data.producers, producerId);
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


    function CreateAttribute() {
        swal({
            title: "{{ trans('Thêm Tính Năng Mới') }}",
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
                    className: "btn btn-danger",
                },
            },
        }).then((Submit) => {
            var nameData = $("#input-field").val();
            if (Submit && nameData) {
                var loadingElement = document.getElementById('loading');
                // Hiển thị thông báo loading
                loadingElement.style.display = 'block';
                $.ajax({
                    url: "{{ route('attribute.store') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
                    },
                    data: {
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
                        buildAttributeForm(response.data)
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

    function CreateSpec(attr_id, attr_name) {
        const targetElm = $(this).parents('.selectgroup');
        swal({
            title: "Thêm Giá Trị " + attr_name + " Mới",
            html: '<br><input class="form-control" placeholder="{{ trans('Nhập Tên Mới') }}" id="input-field-name name="attribute_name" value="'+ name +'">',
            content: {
                element: "input",
                attributes: {
                    placeholder: "{{ trans('Nhập Giá Trị Mới') }}",
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
                    className: "btn btn-danger",
                },
            },
        }).then((Submit) => {
            var nameData = $("#input-field").val();
            if (Submit && nameData) {
                var loadingElement = document.getElementById('loading');
                // Hiển thị thông báo loading
                loadingElement.style.display = 'block';
                $.ajax({
                    url: "{{ route('attribute-spec.store') }}",
                    type: "post",
                    headers: {
                        'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
                    },
                    data: {
                        attribute_id: attr_id,
                        value: nameData
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

                        const specs = response.data;
                        targetElm.empty();
                        for (var j = 0; j < specs.length; j++) {
                            const labelSpec = document.createElement('label');
                            labelSpec.className = 'selectgroup-item';

                            const inputRadioSpec = document.createElement('input');
                            inputRadioSpec.className = 'selectgroup-input spec-input';
                            inputRadioSpec.type = 'radio';
                            inputRadioSpec.name = 'spec-id-'+ attr_id;
                            inputRadioSpec.value = specs[j].id;
                            inputRadioSpec.id = 'spec-input-' + specs[j].id;

                            const spanSpec = document.createElement('span');
                            spanSpec.className = 'selectgroup-button';
                            spanSpec.textContent = specs[j].value

                            labelSpec.appendChild(inputRadioSpec);
                            labelSpec.appendChild(spanSpec);

                            $(targetElm)[0].appendChild(labelSpec);
                        }

                        const btnAddSpec = document.createElement('label');
                        btnAddSpec.className = 'selectgroup-item';
                        btnAddSpec.onclick = function() {
                            CreateSpec.call(this, attr_id, attr_name);
                        };

                        const spanAddSpec = document.createElement('span');
                        spanAddSpec.className = 'selectgroup-button';

                        const iconAddSpec = document.createElement('i');
                        iconAddSpec.className = 'fas fa-plus';

                        spanAddSpec.appendChild(iconAddSpec);
                        btnAddSpec.appendChild(spanAddSpec);

                        $(targetElm)[0].appendChild(btnAddSpec);
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

    $(document).ready(function() {
        function formatCurrencyVND(number) {
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        }

        $('#price').on('input', function() {
            let inputVal = $(this).val();

            // Xóa ký hiệu tiền tệ và dấu phân cách
            let numericValue = inputVal.replace(/[^0-9]/g, '');

            if (numericValue.length > 0) {
                // Lấy vị trí con trỏ hiện tại
                let cursorPosition = this.selectionStart;

                // Định dạng giá trị
                let formattedValue = formatCurrencyVND(Number(numericValue));

                // Gán giá trị đã định dạng vào input
                $(this).val(formattedValue);

                // Đặt lại vị trí con trỏ
                this.setSelectionRange(cursorPosition, cursorPosition);
            } else {
                $(this).val('');
            }
        });

        $('#price').on('focus', function() {
            let inputVal = $(this).val();
            let numericValue = inputVal.replace(/[^0-9]/g, '');

            if (numericValue.length > 0) {
                $(this).val(numericValue);
            }
        });

        $('#price').on('blur', function() {
            let inputVal = $(this).val();
            let numericValue = inputVal.replace(/[^0-9]/g, '');

            if (numericValue.length > 0) {
                let formattedValue = formatCurrencyVND(Number(numericValue));
                $(this).val(formattedValue);
            } else {
                $(this).val('');
            }
        });

        $('#cost_price').on('input', function() {
            let inputVal = $(this).val();

            // Xóa ký hiệu tiền tệ và dấu phân cách
            let numericValue = inputVal.replace(/[^0-9]/g, '');

            if (numericValue.length > 0) {
                // Lấy vị trí con trỏ hiện tại
                let cursorPosition = this.selectionStart;

                // Định dạng giá trị
                let formattedValue = formatCurrencyVND(Number(numericValue));

                // Gán giá trị đã định dạng vào input
                $(this).val(formattedValue);

                // Đặt lại vị trí con trỏ
                this.setSelectionRange(cursorPosition, cursorPosition);
            } else {
                $(this).val('');
            }
        });

        $('#cost_price').on('focus', function() {
            let inputVal = $(this).val();
            let numericValue = inputVal.replace(/[^0-9]/g, '');

            if (numericValue.length > 0) {
                $(this).val(numericValue);
            }
        });

        $('#cost_price').on('blur', function() {
            let inputVal = $(this).val();
            let numericValue = inputVal.replace(/[^0-9]/g, '');

            if (numericValue.length > 0) {
                let formattedValue = formatCurrencyVND(Number(numericValue));
                $(this).val(formattedValue);
            } else {
                $(this).val('');
            }
        });
    });

    $(document).ready(function() {
        let filesArray = [];

        $('#gallery-upload').on('change', function() {
            const files = this.files;
            $.each(files, function(index, file) {
                filesArray.push(file);

                const reader = new FileReader();

                reader.onload = function(e) {
                    const imageContainer = $('<div class="image-container"></div>');
                    const img = $('<img>').attr('src', e.target.result);
                    const removeButton = $('<button class="remove-image">&times;</button>');

                    removeButton.on('click', function() {
                        const fileIndex = filesArray.indexOf(file);
                        if (fileIndex > -1) {
                            filesArray.splice(fileIndex, 1);
                            updateInputFiles(filesArray);
                        }
                        imageContainer.remove();
                    });

                    imageContainer.append(img).append(removeButton);
                    $('#gallery-require').append(imageContainer);
                };

                reader.readAsDataURL(file);
            });
            updateInputFiles(filesArray);
        });

        function updateInputFiles(filesArray) {
            const dataTransfer = new DataTransfer();
            filesArray.map(file => {
                const newFile = new File([file], file.name, { type: file.type });
                dataTransfer.items.add(newFile);
            });

            const inputFiles = document.getElementById('gallery-upload');

            inputFiles.files = dataTransfer.files;
        }
    });
</script>
