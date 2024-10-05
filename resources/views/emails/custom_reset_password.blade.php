<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu Cầu Đặt Lại Mật Khẩu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #01d28e;
            color: white;
            font-size: 1.25rem;
            padding: 1rem;
        }
        .card-body {
            background-color: #f8f9fa;
            padding: 1rem;
        }
        .btn-primary {
            background-color: #01d28e;
            border-color: #01d28e;
            color: white; /* Đảm bảo màu chữ là trắng */
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #10eca4;
            border-color: #10eca4;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: none;
            padding: 1rem;
            font-size: 0.875rem;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            color: #6c757d;
        }
        .card-footer a {
            color: #01d28e;
            text-decoration: none;
        }
        .card-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            {{ __('Yêu Cầu Đặt Lại Mật Khẩu') }}
        </div>
        <div class="card-body">
            <p>{{ __('Xin chào ') }} {{ $name }},</p>
            <p>{{ __('Bạn vừa yêu cầu đặt lại mật khẩu cho tài khoản NiceCar của mình. Vui lòng nhấp vào nút bên dưới để đặt lại mật khẩu:') }}</p>
            <p class="text-center">
                <a href="{{ url('password/reset', $token) . '?email=' . urlencode($email) }}" class="btn btn-primary" style="color: white;">
                    {{ __('Đặt Lại Mật Khẩu') }}
                </a>
            </p>
        </div>
        <div class="card-footer text-center">
            <p>{{ __('Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.') }}</p>
            <p>{{ __('Cảm ơn!') }}</p>
            <p>{{ config('app.name') }}</p>
        </div>
    </div>
</div>
</body>
</html>
