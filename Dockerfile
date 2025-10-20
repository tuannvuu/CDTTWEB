# 🐳 Sử dụng PHP 8.2 kèm Apache
FROM php:8.2-apache

# 1. Cài các extension cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# 2. Kích hoạt mod_rewrite
RUN a2enmod rewrite

# 3. Copy code vào container
WORKDIR /var/www/html
COPY . .

# 4. Cài Composer trực tiếp (thay vì pull từ Docker Hub)
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 5. Set quyền truy cập storage + cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 6. Thiết lập quyền và chạy các lệnh Laravel sau khi container khởi động
ENTRYPOINT bash -c "\
    chmod -R 775 storage bootstrap/cache && \
    php artisan storage:link && \
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan migrate --force && \
    apache2-foreground \
"

# 7. Expose port 80
EXPOSE 80
