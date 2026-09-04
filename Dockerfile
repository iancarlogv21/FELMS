FROM php:8.2-apache

# Install system dependencies required for MongoDB extension and Composer
RUN apt-get update && apt-get install -y \
    libssl-dev \
    unzip \
    git \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files into the container web root
COPY . /var/www/html
WORKDIR /var/www/html

# Install production dependencies
RUN composer install --no-dev --optimize-autoloader

# Configure Apache to listen on Render's dynamic PORT environment variable
RUN sed -i "s/80/\${PORT}/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf

# Start Apache in the foreground
CMD ["apache2-foreground"]