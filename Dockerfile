FROM php:8.2-apache

# Disable memory limits for Composer during build
ENV COMPOSER_MEMORY_LIMIT=-1

RUN apt-get update && apt-get install -y \
    libssl-dev \
    unzip \
    git \
    && pecl install mongodb-1.17.2 \
    && docker-php-ext-enable mongodb

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html
WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN sed -i "s/80/\${PORT}/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf

CMD ["apache2-foreground"]