FROM php:8.2-cli

# Install ekstensi PHP dan tools yang dibutuhkan
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo_mysql mbstring zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project ke dalam container
COPY . .

# Install dependencies dari composer
RUN composer install --no-interaction

# Expose port 8080 untuk Render
EXPOSE 8080

# Jalankan CodeIgniter menggunakan php spark
CMD ["php", "spark", "serve", "--host=0.0.0.0", "--port=8080"]
