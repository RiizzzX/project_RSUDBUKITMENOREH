# RSUD Bukit Menoreh - Phalcon Backend
FROM php:8.1-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl wget zip unzip libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql xml \
    && rm -rf /var/lib/apt/lists/*

# Install build tools & Phalcon
RUN apt-get update && apt-get install -y $PHPIZE_DEPS \
    && pecl install phalcon \
    && docker-php-ext-enable phalcon \
    && apt-get purge -y --auto-remove $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www/html

# Copy project
COPY . .

# Install PHP deps
RUN composer install --prefer-dist --no-interaction --no-dev

# 🔑 PERBAIKAN UTAMA: Ubah document root ke /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Enable Apache modules
RUN a2enmod rewrite headers

# Set permissions
RUN chown -R www-data:www-data . && chmod -R 755 .
RUN mkdir -p cache public/temp && chmod -R 777 cache public/temp

EXPOSE 80

CMD ["apache2-foreground"]