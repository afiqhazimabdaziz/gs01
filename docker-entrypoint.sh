#!/bin/bash

set -e


echo "Preparing Laravel storage..."


# Remove wrong storage folder
if [ -d "/var/www/html/public/storage" ] && \
   [ ! -L "/var/www/html/public/storage" ]; then

    echo "Removing incorrect public/storage directory..."

    rm -rf /var/www/html/public/storage
fi


# Create storage symlink
php artisan storage:link || true


# Cache Laravel config
php artisan config:cache
php artisan route:cache
php artisan view:cache


# Fix permissions
chown -R www-data:www-data storage bootstrap/cache

chmod -R 775 storage bootstrap/cache


echo "Starting Apache..."


exec apache2-foreground