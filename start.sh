#!/bin/bash
set -e

echo "🚀 Starting PHP-FPM..."
php-fpm -F &

echo "🚀 Starting Caddy..."
caddy run --config /app/Caddyfile --adapter caddyfile &

echo "🚀 Starting Queue Worker..."
php artisan queue:work --tries=3 --timeout=300 --verbose &

echo "✅ All services started. Waiting for processes..."

# Wait for any process to exit
wait -n

# Exit with status of process that exited first
exit $?