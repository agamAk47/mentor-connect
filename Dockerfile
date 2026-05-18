FROM php:8.2-apache

# 1. Install system dependencies required for PHP and MongoDB extension
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libssl-dev \
    pkg-config

# Clean APT cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Install and enable MongoDB PECL extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Install standard Laravel PHP extensions
RUN docker-php-ext-install bcmath mbstring exif pcntl

# 3. Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# 4. Configure Apache VirtualHost to point directly to public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Set working directory
WORKDIR /var/www/html

# 6. Install latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Copy all application project files
COPY . .

# 8. Install production dependencies without running dev tools
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# 9. Ensure correct permissions for web server
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
