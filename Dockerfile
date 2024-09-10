FROM richarvey/nginx-php-fpm:1.7.2

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cài đặt các phần phụ thuộc hệ thống cần thiết
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Sao chép mã nguồn ứng dụng vào container
COPY . /var/www/html

# Thiết lập quyền sở hữu cho thư mục ứng dụng
RUN chown -R www-data:www-data /var/www/html

# Cài đặt các phụ thuộc của ứng dụng Laravel
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Cấu hình môi trường
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Cho phép Composer chạy dưới quyền root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Lệnh khởi động
CMD ["/start.sh"]