# ==========================================
# ÉTAPE 1 : Construction du frontend Vite
# ==========================================
FROM node:22 AS frontend

WORKDIR /app

# Installation des dépendances Node.js
COPY package.json package-lock.json ./
RUN npm ci

# Copie du projet
COPY . .

# Construction CSS/JS avec Vite
RUN npm run build


# ==========================================
# ÉTAPE 2 : Application Laravel
# ==========================================
FROM php:8.2-cli

WORKDIR /var/www/html

# Installation des dépendances système et PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install \
    pdo_mysql \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installation des dépendances PHP
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Copie de tout le projet
COPY . .

# Copie des fichiers construits par Vite
COPY --from=frontend /app/public/build ./public/build

# Création des dossiers Laravel nécessaires
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# Permissions Laravel
RUN chmod -R 775 storage bootstrap/cache

# Optimisation Composer
RUN composer dump-autoload --optimize

# Port utilisé par Render
EXPOSE 10000

# Démarrage de Laravel
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]