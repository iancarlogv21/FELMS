FROM php:8.2-apache

# Point Apache document root to the public folder (use only if your project files are inside a public subdirectory)
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Install system dependencies and OpenSSL (required for MongoDB driver)
RUN apt-get update && apt-get install -y \
    libssl-dev \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install the official MongoDB PECL extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Set working directory to Apache's web root
WORKDIR /var/www/html

# Copy project files (including your local vendor folder) into the container
COPY . /var/www/html

# Expose port 80 for web traffic
EXPOSE 80