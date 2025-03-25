# Step 1: Use PHP 8.2 with Apache
FROM php:8.2-apache

# Step 2: Install System Dependencies
RUN apt-get update && apt-get install -y \
    zip unzip curl git libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# Step 3: Enable Apache Rewrite Module
RUN a2enmod rewrite

# Step 4: Set Working Directory
WORKDIR /var/www/html

# Step 5: Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 6: Copy Laravel Project Files
COPY . .

# Step 7: Install Laravel Dependencies
RUN composer install --no-dev --optimize-autoloader

# Step 8: Generate Application Key
RUN php artisan key:generate

# Step 9: Set Permissions
RUN chmod -R 777 storage bootstrap/cache

# Step 10: Expose Apache Port
EXPOSE 80

# Step 11: Start Apache Server
CMD ["apache2-foreground"]
