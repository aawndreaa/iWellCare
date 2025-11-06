#!/usr/bin/env bash
# Railway build script for Laravel
set -o errexit

echo "🚀 Starting Railway build process..."

# Install PHP dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Skip Node.js build - no frontend assets in this Laravel app
echo "⏭️ Skipping Node.js build - no package.json found"

# Generate application key if not exists
echo "🔑 Generating application key..."
php artisan key:generate --no-interaction --force

# Clear and cache config
echo "⚙️ Caching configuration..."
php artisan config:clear
php artisan config:cache

# Clear and cache routes
echo "🛣️ Caching routes..."
php artisan route:clear
php artisan route:cache

# Clear and cache views
echo "👁️ Caching views..."
php artisan view:clear
php artisan view:cache

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

# Run migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force --no-interaction

# Optimize for production
echo "⚡ Optimizing for production..."
php artisan optimize

echo "✅ Railway build completed successfully!"