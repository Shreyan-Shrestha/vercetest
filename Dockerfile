# Stage 1 - Build Frontend (Vite)
FROM node:18-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci --silent
COPY . .
RUN npm run build

# Stage 2 - Production (Nginx + PHP-FPM)
FROM php:8.4-fpm-alpine

# Install system dependencies - only packages available in Alpine
RUN apk add --no-cache \
    git \
    curl \
    unzip \
    bash \
    nginx \
    supervisor \
    postgresql-client

# Install PHP build dependencies and extensions
RUN apk add --no-cache --virtual .build-deps \
    libpq-dev \
    oniguruma-dev \
    libzip-dev

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    zip

# Remove build dependencies to reduce image size
RUN apk del .build-deps

# Configure PHP for better performance
RUN echo "memory_limit = 512M" > /usr/local/etc/php/conf.d/memory.ini && \
    echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/memory.ini && \
    echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/memory.ini

# Configure PHP-FPM to listen on TCP instead of socket
RUN sed -i 's|listen = /run/php-fpm.sock|listen = 127.0.0.1:9000|g' /usr/local/etc/php-fpm.d/www.conf

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy only composer files first for better caching
COPY composer.json composer.lock* ./

# Install PHP dependencies with verbose output and error handling
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Copy rest of the app files
COPY . .

# Copy built frontend from Stage 1
COPY --from=frontend /app/public/build ./public/build

# Create .env for build
RUN if [ ! -f .env ]; then cp .env.example .env 2>/dev/null || echo "APP_KEY=" > .env; fi

# Skip artisan commands that need DB connection
# These will be run after deployment on Render
RUN composer run-script post-autoload-dump || true

# Set proper permissions
RUN chown -R nobody:nobody /var/www && \
    chmod -R 755 storage bootstrap/cache && \
    chmod -R 777 storage bootstrap/cache

# Copy Nginx configuration
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/conf.d/default.conf

# Copy Supervisor configuration
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Create required directories
RUN mkdir -p /var/run/nginx /var/log/supervisor && \
    chmod 777 /var/run/nginx

# Expose port
EXPOSE 10000

# Start supervisor to manage both nginx and php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
