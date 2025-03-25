# Step 1: Use PHP 8.2 with Apache
FROM php:8.2-apache

# Step 2: Install System Dependencies
RUN apt-get update && apt-get install -y \
    zip unzip curl git libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# Step 3: Enable Apache Rewrite Module
RUN a2enmod rewrite

# Step 4: Set Working Directory to Laravel Root
WORKDIR /var/www/html

# Step 5: Copy Laravel Project Files
COPY . .

# Step 6: Copy Apache Configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Step 7: Set Permissions for Storage & Cache
RUN chmod -R 777 storage bootstrap/cache

# Step 8: Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 9: Ensure .env File Exists
RUN cp .env.example .env || true

# Step 10: Install Laravel Dependencies & Generate App Key
RUN composer install --no-dev --optimize-autoloader || true && php artisan key:generate || true

# Step 11: Expose Apache Port
EXPOSE 80

# Step 12: Start Apache Server
CMD ["apache2-foreground"]
