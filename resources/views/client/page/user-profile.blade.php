@extends('client.layout.client_layout')

@section('content')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>
        #ftco-navbar .navbar-nav .nav-link {
            color: #000000 !important;
        }

        #ftco-navbar .navbar-nav .nav-link:hover {
            color: #333333 !important;
        }

        #ftco-navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .ftco-navbar-light .navbar-brand {
            color: black !important;
        }

        .ftco-navbar-light {
            top: 0 !important;
        }

        .card-header {
            background-color: #01d28e;
            color: #FFFFFF;
        }

        .edit-icon {
            float: right;
            cursor: pointer;
            color: #01d28e;
            font-size: 1.2rem;
        }

        .edit-icon-password {
            float: right;
            cursor: pointer;
            color: #01d28e;
            font-size: 1.2rem;
        }

        .editable-field {
            border: none;
            background-color: #FFFFFF;
        }

        .save-btn {
            background-color: #01d28e;
            color: white;
            display: none;
        }

        .change-password-btn {
            background-color: #01d28e;
        }

        .cancel-btn {
            display: none;
        }

        .profile-info {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-info p {
            width: 100%;
        }

        .avatar-container {
            position: relative;
            cursor: pointer;
        }

        .avatar-container img {
            border-radius: 50%;
        }

        .avatar-container:hover::after {
            content: 'Thay đổi ảnh';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
        }

        .message-validate {
            color: red;
        }
    </style>

    <section class="ftco-section ftco-car-details">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('user-profile-update') }}" method="POST" id="user-update-form" enctype="multipart/form-data">
                        @csrf
                    <div class="card">
                        <div class="card-header">{{ __('Thông Tin Hồ Sơ') }}</div>

                        <div class="card-body">
                            <div class="text-center">
                                <div class="avatar-container">
                                    <img src="{{ asset($user->avatar) }}" class="rounded-circle" id="avatar_preview" width="150" height="150" alt="User Avatar">
                                    <input type="file" id="avatar" name="avatar" hidden accept="image/*">
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="profile-info">
                                    <p><strong>{{ __('Tên:') }}</strong>
                                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="editable-field form-control" readonly>
                                    </p>
                                    <i class="edit-icon fas fa-edit" data-edit-target="name"></i>
                                </div>

                                <div class="profile-info">
                                    <p><strong>{{ __('Email:') }}</strong>
                                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="editable-field form-control" readonly>
                                    </p>
                                </div>

                                <div class="profile-info">
                                    <p><strong>{{ __('Chức Vụ:') }}</strong>
                                        <input type="text" id="user_roles" value="{{ $user->roles->name }}" class="editable-field form-control" readonly>
                                    </p>
                                </div>

                                <div class="profile-info">
                                    <p><strong>{{ __('Mật Khẩu:') }}</strong>
{{--                                        <input type="password" id="user_password" value="{{ $user->password }}" class="editable-field form-control" readonly>--}}
                                        <i data-toggle="modal" data-target="#changePasswordModal" class="edit-icon-password fas fa-edit"></i>
                                    </p>
                                </div>

                                <button class="btn save-btn" id="save_changes">{{ __('Lưu Thay Đổi') }}</button>
                                <button class="btn cancel-btn" id="cancel_changes">{{ __('Hủy') }}</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Đổi Mật Khẩu -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">{{ __('Đổi Mật Khẩu') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="password-change-form" action="{{ route('user-password-update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">{{ __('Mật khẩu hiện tại:') }}</label>
                                <input type="password" name="current_password" id="current_password"
                                       class="form-control">
                                <span id="current_password_error" class="message-validate"></span>
                            </div>

                            <div class="form-group">
                                <label for="new_password">{{ __('Mật khẩu mới:') }}</label>
                                <input type="password" name="new_password" id="new_password" class="form-control">
                                <span id="new_password_error" class="message-validate"></span>
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation">{{ __('Xác nhận mật khẩu mới:') }}</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                       class="form-control">
                                <span id="new_password_confirmation_error" class="message-validate"></span>
                            </div>

                            <button type="submit" class="btn" style="background-color: #01d28e; color: #FFFFFF">{{ __('Lưu thay đổi') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            // Khi nhấn vào avatar, tự động mở input chọn file
            $('.avatar-container').one('click', function () {
                $('#avatar').click();
            });

            // Hiển thị preview khi người dùng chọn ảnh mới
            $('#avatar').on('change', function () {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);

                // Hiển thị nút lưu sau khi chọn ảnh
                $('.save-btn').show();
                $('.cancel-btn').show();
            });

            $('.edit-icon').on('click', function () {
                var targetField = $(this).data('edit-target');
                $('#' + targetField).removeAttr('readonly').focus().css('border', '1px solid #ddd');
                $('.save-btn').show();
                $('.cancel-btn').show();
            });

            $('#save_changes').on('click', function () {

                $('#user-update-form').submit();

                $('.editable-field').attr('readonly', true).css('border', 'none');
                $('.save-btn').hide();
                $('.cancel-btn').hide();
            });

            $('#cancel_changes').on('click', function () {
                $('.editable-field').attr('readonly', true).css('border', 'none');
                $('.save-btn').hide();
                $('.cancel-btn').hide();
            });

            $('#password-change-form').on('submit', function (e) {
                var currentPassword = $('#current_password').val();
                var newPassword = $('#new_password').val();
                var confirmPassword = $('#new_password_confirmation').val();

                if (!currentPassword) {
                    e.preventDefault();
                    $('#current_password_error').text('Mật khẩu cũ không được để trống!');
                    $('#current_password').css('border', '1px solid red');
                } else {
                    $('#current_password_error').text('');
                    $('#current_password').css('border', '1px solid #ddd');
                }

                if (!newPassword) {
                    e.preventDefault();
                    $('#new_password_error').text('Mật khẩu mới không được để trống!');
                    $('#new_password').css('border', '1px solid red');
                } else {
                    $('#new_password_error').text('');
                    $('#new_password').css('border', '1px solid #ddd');
                }

                if (!confirmPassword) {
                    e.preventDefault();
                    $('#new_password_confirmation_error').text('Mật khẩu xác nhận không được để trống!');
                    $('#new_password_confirmation').css('border', '1px solid red');
                } else {
                    $('#new_password_confirmation_error').text('');
                    $('#new_password_confirmation').css('border', '1px solid #ddd');
                }

                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    $('#new_password_confirmation_error').text('Xác nhận mật khẩu không khớp!');
                    $('#new_password_confirmation').css('border', '1px solid red');
                } else {
                    $('#new_password_confirmation_error').text('');
                    $('#new_password_confirmation').css('border', '1px solid #ddd');
                }
            });
        });
    </script>
@stop