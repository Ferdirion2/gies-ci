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


# ==========================================
# Extensions système nécessaires
# ==========================================
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


# ==========================================
# Installation de Composer
# ==========================================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


# ==========================================
# Copier le projet Laravel
# ==========================================
COPY . .


# ==========================================
# Copier les fichiers Vite compilés
# ==========================================
COPY --from=frontend /app/public/build ./public/build


# ==========================================
# Créer les répertoires nécessaires à Laravel
# ==========================================
RUN mkdir -p \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache


# ==========================================
# Installer les dépendances PHP
# ==========================================
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader


# ==========================================
# Permissions Laravel
# ==========================================
RUN chmod -R 775 storage bootstrap/cache


# ==========================================
# Entrypoint
# ==========================================
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh


# ==========================================
# Port Render
# ==========================================
EXPOSE 10000


# ==========================================
# Démarrage de l'application
# ==========================================
ENTRYPOINT ["docker-entrypoint.sh"]