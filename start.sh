#!/bin/bash

# Khởi động PHP-FPM
php-fpm &

# Khởi động Nginx
nginx -g 'daemon off;'