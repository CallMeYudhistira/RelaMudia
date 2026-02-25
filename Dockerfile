# ==============================
# Stage 1: PHP Composer Builder
# ==============================
FROM composer:latest AS composer_builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --ignore-platform-reqs

# ==============================
# Stage 2: Node Asset Builder
# ==============================
FROM node:20-alpine AS node_builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY resources ./resources
COPY vite.config.js ./
RUN npm run build

# ==============================
# Stage 3: Final Runtime (FrankenPHP)
# ==============================
FROM dunglas/frankenphp:latest-php8.3-bookworm AS runtime

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev libzip-dev unzip curl \
    && rm -rf /var/lib/apt/lists/*

RUN install-php-extensions pdo_mysql gd intl zip pcntl bcmath opcache posix

# Enable OPcache for CLI (Required for Workers)
RUN echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

WORKDIR /app

# Copy application files
COPY . .
COPY --from=composer_builder /app/vendor ./vendor
COPY --from=node_builder /app/public/build ./public/build

# Finalize Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer dump-autoload --optimize --no-dev

# Copy Caddyfile to the correct system location
COPY Caddyfile /etc/caddy/Caddyfile

# Ensure storage is writable
RUN chmod -R 777 storage bootstrap/cache public

# Configure FrankenPHP environment
ENV SERVER_NAME=:80
ENV OCTANE_SERVER=frankenphp

# Prepare Startup Script
COPY start-container.sh /usr/local/bin/start-container.sh
RUN sed -i 's/\r$//' /usr/local/bin/start-container.sh \
    && chmod +x /usr/local/bin/start-container.sh

EXPOSE 80

ENTRYPOINT ["/bin/bash", "/usr/local/bin/start-container.sh"]
