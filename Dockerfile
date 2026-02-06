FROM node:22-alpine AS node-builder

WORKDIR /app

COPY package.json vite.config.js ./
RUN npm install

COPY resources ./resources
COPY public ./public

RUN npm run build

FROM php:8.3-fpm-bookworm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    postgresql-client \
    supervisor \
    unzip \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json ./
RUN composer install --no-autoloader --no-scripts --prefer-dist

COPY --from=node-builder /app/public/build ./public/build

COPY . .

RUN mkdir -p storage/framework/views storage/logs
RUN mkdir -p bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache
RUN chown -R 1000:1000 storage bootstrap/cache

COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 9000

CMD ["php-fpm"]
