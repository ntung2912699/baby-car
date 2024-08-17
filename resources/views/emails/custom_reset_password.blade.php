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
            background-color: #007bff;
            color: white;
            font-size: 1.25rem;
            padding: 1rem;
        }
        .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: white; /* Đảm bảo màu chữ là trắng */
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            Yêu Cầu Đặt Lại Mật Khẩu
        </div>
        <div class="card-body">
            <p>Xin chào {{ $name }},</p>
            <p>Bạn vừa yêu cầu đặt lại mật khẩu cho tài khoản NiceCar của mình. Vui lòng nhấp vào nút bên dưới để đặt lại mật khẩu:</p>
            <p class="text-center">
                <a href="{{ url('password/reset', $token) . '?email=' . urlencode($email) }}" class="btn btn-primary" style="color: white;">
                    Đặt Lại Mật Khẩu
                </a>
            </p>
            <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
            <p>Cảm ơn!</p>
        </div>
    </div>
</div>
</body>
</html>
