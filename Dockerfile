# ==========================================
# ÉTAPE 1 : Construction du frontend Vite
# ==========================================
FROM node:22 AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .

RUN npm run build


# ==========================================
# ÉTAPE 2 : Application Laravel
# ==========================================
FROM php:8.2-cli

WORKDIR /var/www/html

# Extensions système nécessaires à Filament, Spatie Permission, et l'import/export (openspout)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_mysql \
    zip \
    intl \
    mbstring \
    gd \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# On copie TOUT le projet AVANT composer install,
# pour que "artisan" existe déjà quand les scripts post-autoload-dump s'exécutent
COPY . .

# Récupère les assets déjà compilés par Vite (étape 1)
COPY --from=frontend /app/public/build ./public/build

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 10000

ENTRYPOINT ["docker-entrypoint.sh"]