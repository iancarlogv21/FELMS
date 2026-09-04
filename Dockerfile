FROM php:8.2-apache

# Install system dependencies and OpenSSL (required for MongoDB driver)
RUN apt-get update && apt-get install -y \
    libssl-dev \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install the official MongoDB PECL extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory to Apache's web root
WORKDIR /var/www/html

# Copy project files into the container
COPY . /var/www/html

# Install production dependencies via Composer, ignoring platform extension checks
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Expose port 80 for web traffic
EXPOSE 80