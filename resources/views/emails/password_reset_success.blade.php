<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã OTP</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #01d28e;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 1.25rem;
            padding: 1rem;
        }
        .card-body {
            padding: 1rem;
            background-color: #f8f9fa;
        }
        .card-body h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 1rem 0;
            color: #01d28e;
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
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    {{ __('Xin Chào ') }} {{ $user->name }}!
                    <br>
                    {{ __('Mật khẩu tài khoản Auto99 của bạn vừa được thay đổi thành công') }}
                </div>
                <div class="card-body text-center">
                    <p>{{ __('Mật khẩu của bạn đã được thiết lập lại thành công vào : ') }} {{ $datetime }}.</p>
                    <p><strong>{{ __('Thiết bị : ') }}</strong> {{ $device }}</p>
                    <p>{{ __('Nếu bạn không thực hiện hành động này hoặc không nhận ra thiết bị sau, vui lòng liên hệ ngay với nhóm hỗ trợ của chúng tôi.') }}</p>
                </div>
                <div class="card-footer text-center">
                    <p>{{ __('Cảm ơn!') }}</p>
                    <p>{{ config('app.name') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>