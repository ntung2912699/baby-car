#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html
composer update
composer dump-autoload

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan session:table
php artisan migrate

 echo "running image link"
 php artisan storage:link
