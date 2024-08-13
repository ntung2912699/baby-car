@extends('auth.auth_layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4>{{ __('Login') }}</h4>
                    </div>

                    <div class="card-body">
                        @if ($errors->has('error'))
                            <div class="alert alert-danger">
                                {{ $errors->first('error') }}
                            </div>
                        @endif
                        <form method="POST" id="login-form" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Địa Chỉ Email') }}</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <span class="invalid-feedback" role="alert" style="display: none;">
                                <strong>{{ __('Email không hợp lệ') }}</strong>
                            </span>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                <span class="invalid-feedback" role="alert" style="display: none;">
                                <strong>{{ __('Mật khẩu không được để trống') }}</strong>
                                </span>
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
@endsection
