FROM php:8.2-apache

# Install system dependencies and exact MongoDB extension
RUN apt-get update && apt-get install -y \
    libssl-dev \
    unzip \
    git \
    && pecl install mongodb-1.17.2 \
    && docker-php-ext-enable mongodb

# Copy all project files (including the pre-built vendor folder)
COPY . /var/www/html
WORKDIR /var/www/html

# Configure Apache port for Render
RUN sed -i "s/80/\${PORT}/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf

CMD ["apache2-foreground"]