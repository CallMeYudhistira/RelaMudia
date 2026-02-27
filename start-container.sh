#!/bin/bash
echo "--- Starting relamudia_app (Production Native Mode) ---"

# 1. Ensure required directories exist
mkdir -p storage/app/public \
         storage/framework/{sessions,views,cache} \
         storage/logs
chmod -R 777 storage bootstrap/cache public

# 2. Handle .env and APP_KEY
# If .env doesn't exist AND APP_KEY isn't in the system environment, create one
if [ ! -f .env ] && [ -z "$APP_KEY" ]; then
    echo "No .env file or APP_KEY environment variable found. Creating from .env.example..."
    cp .env.example .env
fi

# Only generate a key if one isn't already present in the .env file OR the system environment
if [ -f .env ] && ! grep -q "^APP_KEY=base64:" .env && [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force --no-interaction
fi

# 3. Cleanup Development Artifacts
# CRITICAL: Remove the 'hot' file to force Laravel to use production assets
if [ -f public/hot ]; then
    echo "Removing Vite development hot file..."
    rm public/hot
fi

# 4. Wait for database
echo "Waiting for database ($DB_HOST)..."
until php -r "try { new PDO('mysql:host=' . getenv('DB_HOST') . ';port=3306', getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0); } catch (Exception \$e) { exit(1); }"; do
  sleep 2
done
echo "Database connected!"

# 5. Migrations
echo "Running migrations..."
php artisan migrate --force --no-interaction

# 6. Laravel Optimizations
echo "Optimizing configuration..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Fix storage link
if [ -L public/storage ] || [ -d public/storage ]; then
    rm -rf public/storage
fi
echo "Creating storage link..."
ln -sf ../storage/app/public public/storage

# 7. Start FrankenPHP DIRECTLY
echo "Starting FrankenPHP in Worker Mode..."
exec frankenphp run --config /etc/caddy/Caddyfile
