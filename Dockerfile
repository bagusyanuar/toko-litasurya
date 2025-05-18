# Stage 1: PHP dengan ekstensi lengkap
FROM php:8.2-fpm AS app

# Install dependencies dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libxpm-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nano \
    default-mysql-client \
    gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
        --with-xpm \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        exif \
        pcntl \
        bcmath \
        intl \
        gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files
COPY composer.json composer.lock ./

# Jalankan composer install
RUN composer install --no-scripts --prefer-dist --no-interaction --no-progress

# Copy semua source code ke container
COPY . .

RUN npm install && npm run build

# Copy installed vendor from composer stage
COPY --from=composer /app/vendor ./vendor

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Expose port PHP-FPM
EXPOSE 9000


CMD ["php-fpm"]
