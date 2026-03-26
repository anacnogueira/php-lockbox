FROM php:8.5-fpm-alpine

# Instala dependências do sistema (necessárias para o Composer e extensões PHP)
RUN apk add --no-cache \
    git \
    unzip \
    libzip-dev \
    zip

# O PULO DO GATO: Copia o binário do Composer da imagem oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# (Opcional) Instala extensões PHP comuns para projetos modernos
RUN docker-php-ext-install zip pdo_mysql

WORKDIR /var/www/html