@extends('auth.auth_layout')

@section('content')
    <style>
        .invalid-feedback {
            display: none; /* Ẩn thông báo lỗi theo mặc định */
            color: #dc3545; /* Màu đỏ cho thông báo lỗi */
        }
    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4>{{ __('Đăng Ký Tài Khoản') }}</h4>
                    </div>

                    <div class="card-body">
                        @if ($errors->has('session'))
                            <div class="alert alert-danger">
                                {{ $errors->first('session') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        <form method="POST" action="{{ route('verify-otp') }}" id="registration-form">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Tên') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                <div class="invalid-feedback">
                                    {{ __('Vui lòng nhập tên của bạn.') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Địa Chỉ Email') }}</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email">
                                <div class="invalid-feedback">
                                    {{ __('Vui lòng nhập địa chỉ email hợp lệ.') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Mật Khẩu') }}</label>
                                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                                <div class="invalid-feedback">
                                    {{ __('Vui lòng nhập mật khẩu.') }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Xác Nhận Mật Khẩu') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                <div class="invalid-feedback">
                                    {{ __('Vui lòng xác nhận mật khẩu của bạn.') }}
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Đăng Ký') }}
                                    </button>
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        {{ __('Đăng Nhập') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#registration-form').on('submit', function (event) {
                let valid = true;

                // Xóa các lớp lỗi cũ
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').hide();

                // Kiểm tra từng trường
                const name = $('#name');
                if (!name.val().trim()) {
                    valid = false;
                    name.addClass('is-invalid');
                    name.next('.invalid-feedback').show();
                }

                const email = $('#email');
                if (!email.val().trim() || !/\S+@\S+\.\S+/.test(email.val())) {
                    valid = false;
                    email.addClass('is-invalid');
                    email.next('.invalid-feedback').show();
                }

                const password = $('#password');
                if (!password.val().trim()) {
                    valid = false;
                    password.addClass('is-invalid');
                    password.next('.invalid-feedback').show();
                }

                const passwordConfirm = $('#password-confirm');
                if (password.val() !== passwordConfirm.val()) {
                    valid = false;
                    passwordConfirm.addClass('is-invalid');
                    passwordConfirm.next('.invalid-feedback').show();
                }

                // Ngăn chặn gửi form nếu không hợp lệ
                if (!valid) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
