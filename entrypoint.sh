#!/bin/sh
set -e

echo "🔍 Checking application dependencies..."

# Composer install jika vendor tidak ada atau composer.lock terbaru
if [ ! -d "/var/www/vendor" ] || [ /var/www/composer.lock -nt /var/www/vendor ]; then
  echo "📦 Running composer install..."
  composer install --no-dev --optimize-autoloader --no-interaction
else
  echo "✅ Composer dependencies are up to date."
fi

# NPM install dan build jika node_modules tidak ada atau package.json terbaru
if [ ! -d "/var/www/node_modules" ] || [ /var/www/package.json -nt /var/www/node_modules ]; then
  echo "📦 Running npm install and build..."
  npm install
  npm run build
else
  echo "✅ NPM dependencies and build are up to date."
fi

# Set permission (opsional, bisa disesuaikan)
chown -R www-data:www-data /var/www
chmod -R 755 /var/www

echo "🚀 Starting PHP-FPM..."
exec "$@"
