@extends('auth.auth_layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4>{{ __('Xác Thực OTP') }}</h4>
                    </div>

                    <div class="card-body">
                        @if ($errors->has('otp'))
                            <div class="alert alert-danger">
                                {{ $errors->first('otp') }}
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('registerVerifyOtp') }}" id="otp-form">
                            @csrf
                            <div class="mb-3">
                                <label for="otp" class="form-label">{{ __('Nhập Mã OTP') }}</label>
                                <a class="btn btn-link" style="color:#01d28e;" href="{{ route('resend-otp') }}">
                                    {{ __('Gửi Lại OTP') }}
                                </a>
                                <input id="otp" type="text" class="form-control @if ($errors->has('otp')) is-invalid @endif" name="otp" value="{{ old('otp') }}" autocomplete="off" autofocus>
{{--                                @if ($errors->has('otp'))--}}
{{--                                    <div class="invalid-feedback">--}}
{{--                                        {{ $errors->first('otp') }}--}}
{{--                                    </div>--}}
{{--                                @endif--}}
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn" style="background-color: #01d28e; color: #FFFFFF">
                                        {{ __('Xác Thực') }}
                                    </button>
                                    <a class="btn btn-link" style="color:#01d28e;" href="{{ route('register') }}">
                                        {{ __('Quay Lại') }}
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
            $('#otp-form').on('submit', function (event) {
                let valid = true;

                // Xóa các lớp lỗi cũ
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').hide();

                // Kiểm tra trường OTP
                const otp = $('#otp');
                if (!otp.val().trim() || otp.val().length !== 6 || !/^\d{6}$/.test(otp.val())) {
                    valid = false;
                    otp.addClass('is-invalid');
                    otp.next('.invalid-feedback').show();
                }

                // Ngăn chặn gửi form nếu không hợp lệ
                if (!valid) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
