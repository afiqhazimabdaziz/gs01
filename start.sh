#!/bin/bash
set -e

echo "🚀 Starting Queue Worker..."
php artisan queue:work --tries=3 --timeout=300 --verbose

# Keep the container alive
wait