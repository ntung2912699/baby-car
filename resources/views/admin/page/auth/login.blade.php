@extends('auth.auth_layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4>{{ __('Login') }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" id="login-form" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Địa Chỉ Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit" id="btn-login" class="btn btn-primary w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Quên Mật Khẩu?') }}
                                    </a>
                                @endif
                                <a class="btn btn-link" href="{{ route('register') }}">
                                    {{ __('Đăng Ký Tài Khoản') }}
                                </a>
                            </div>
                        </form>

                        <hr>

                        <div class="text-center">
                            <p>{{ __('Hoặc đăng nhập bằng') }}</p>
                            <a href="{{ url('login/facebook') }}" class="btn btn-primary w-100 mb-2">
                                <i class="fab fa-facebook-f"></i> {{ __('Đăng nhập bằng Facebook') }}
                            </a>
                            <a href="{{ route('login.google') }}" class="btn btn-danger w-100">
                                <i class="fab fa-google"></i> {{ __('Đăng nhập bằng Google') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#btn-login").on('click', function (e) {
            e.preventDefault();
            var email_input = $('#email').val();
            var password_input = $('#password').val();
            var remember_input = $('#remember').is(':checked') ? 'on' : 'off';
            var form_data = new FormData();
            form_data.append('email', email_input);
            form_data.append('password', password_input);
            form_data.append('remember', remember_input);
            $.ajax({
                type: "POST",
                url: "{{ route('api.login') }}",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function (response) {
                    swal("{{ trans('Success') }}!", "{{ trans('Đăng Nhập Thành Công') }}!", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                    const token = response.access_token;
                    localStorage.setItem('access_token', token);
                    localStorage.setItem('user_name', response.user.name);
                    localStorage.setItem('email', response.user.email);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("{{ trans('Error') }}!", "{{ trans('Lấy Token Thất Bại') }}!", {
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
    </script>
@endsection
