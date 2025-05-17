#!/bin/bash

echo "🚀 Starting Laravel container..."

# Jalankan composer install kalau vendor belum ada
if [ ! -d "/var/www/vendor" ]; then
    echo "📦 Running composer install..."
    composer install --no-dev --optimize-autoloader
fi

# Jalankan npm run build kalau folder build belum ada
if [ ! -d "/var/www/public/build" ]; then
    echo "🔧 Running npm install and build..."
    npm install && npm run build
fi

# Set permission
echo "🔐 Fixing file permissions..."
chown -R www-data:www-data /var/www
chmod -R 755 /var/www

# Start PHP-FPM
echo "✅ Starting PHP-FPM..."
exec php-fpm
