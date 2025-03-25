# Step 1: PHP with Apache
FROM php:8.2-apache

# Step 2: System Dependencies Install
RUN apt-get update && apt-get install -y \
    zip unzip curl libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# Step 3: Enable Apache Rewrite Module
RUN a2enmod rewrite

# Step 4: Set Working Directory
WORKDIR /var/www/html

# Step 5: Copy Laravel Project Files
COPY . .

# Step 6: Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 7: Install Laravel Dependencies
RUN composer install --no-dev --optimize-autoloader && php artisan key:generate

# Step 8: Give Permissions
RUN chmod -R 777 storage bootstrap/cache

# Step 9: Expose Port
EXPOSE 80

# Step 10: Start Apache Server
CMD ["apache2-foreground"]
