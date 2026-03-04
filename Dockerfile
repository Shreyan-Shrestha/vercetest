# Stage 1 - Build Frontend (Vite)
FROM node:18-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci --silent
COPY . .
RUN npm run build

# Stage 2 - Production (Nginx + PHP-FPM)
FROM php:8.4-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git curl unzip libpq-dev oniguruma-dev libzip-dev \
    nginx supervisor bash postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip

# Configure PHP-FPM to listen on TCP instead of socket
RUN sed -i 's|listen = /run/php-fpm.sock|listen = 127.0.0.1:9000|g' /usr/local/etc/php-fpm.d/www.conf && \
    sed -i 's|;listen.owner|listen.owner|g' /usr/local/etc/php-fpm.d/www.conf && \
    sed -i 's|;listen.group|listen.group|g' /usr/local/etc/php-fpm.d/www.conf

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy app files
COPY . .

# Copy built frontend from Stage 1
COPY --from=frontend /app/public/build ./public/build

# Create .env for build if it doesn't exist
RUN if [ ! -f .env ]; then cp .env.example .env 2>/dev/null || echo "APP_KEY=" > .env; fi

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Attempt to cache configs (non-blocking - these might fail without DB)
RUN php artisan config:cache || true && \
    php artisan route:cache || true

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
