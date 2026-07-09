#!/bin/bash

set -e


echo "Checking Apache MPM..."

apache2ctl -M | grep mpm || true


echo "Preparing Laravel..."


STORAGE_LINK="/var/www/html/public/storage"


if [ -e "$STORAGE_LINK" ] || [ -L "$STORAGE_LINK" ]; then
    echo "Removing existing storage link..."
    rm -rf "$STORAGE_LINK"
fi


php artisan storage:link || true


php artisan config:cache

php artisan route:cache

php artisan view:cache


chown -R www-data:www-data \
    storage \
    bootstrap/cache


chmod -R 775 \
    storage \
    bootstrap/cache


echo "Starting Apache..."


exec apache2-foreground