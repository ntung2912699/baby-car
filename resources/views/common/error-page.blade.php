<!DOCTYPE html>
<html lang="en">
@include('client.layout.component_layout.head')
<body>
<!-- END nav -->

<style>
    .ftco-section {
        padding: 100px 0;
        text-align: center;
        /*background-color: #f8f9fa;*/
    }

    .error-404 {
        max-width: 600px;
        margin: 0 auto;
    }

    .error-404 h1 {
        font-size: 120px;
        color: #ff6f61;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .error-404 h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .error-404 p {
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
    }

    .error-404 a {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #01d28e;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .error-404 a:hover {
        background-color: #019f75;
    }
</style>

<section class="ftco-section ftco-car-details">
    <div class="container">
        <div class="error-404">
            <h1>404</h1>
            <h2>{{ __('Đã Xả Ra Lỗi') }}</h2>
            <p>{{ __('Rất tiếc, đã xảy ra lỗi trong quá trình kết nối đến Facebook.') }}</p>
            <p>{{ $message }}</p>
            <a href="{{ route('home') }}">{{ __('Quay Về Trang Chủ') }}</a>
        </div>
    </div>
</section>

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
@include('client.layout.component_layout.script')

</body>
</html>
