# ==========================
# Stage 1: Build frontend
# ==========================

FROM node:20 AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build


# ==========================
# Stage 2: Laravel + Apache
# ==========================

FROM php:8.3-apache

WORKDIR /var/www/html


# Install dependencies

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
    && rm -rf /var/lib/apt/lists/*


# Install composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


# Copy Laravel

COPY . .


# Copy Vite build

COPY --from=frontend /app/public/build ./public/build


# Install Laravel packages

RUN composer install \
    --no-interaction \
    --no-dev \
    --optimize-autoloader \
    --ignore-platform-reqs


# ==========================
# Apache configuration
# ==========================


ENV APACHE_DOCUMENT_ROOT=/var/www/html/public


# Change only VirtualHost root

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf


# Remove ALL MPM modules first

RUN rm -f \
    /etc/apache2/mods-enabled/mpm_*.load \
    /etc/apache2/mods-enabled/mpm_*.conf


# Enable only prefork

RUN a2enmod mpm_prefork \
    && a2enmod rewrite


# Debug MPM during build

RUN echo "Enabled Apache MPM:" \
    && ls -la /etc/apache2/mods-enabled | grep mpm


# Entry point

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh


# Permissions

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache


EXPOSE 80


ENTRYPOINT ["docker-entrypoint.sh"]