FROM php:7.3-fpm



# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    wget \
    libicu-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    git \
    unzip \
    zlibc \
    libzip-dev \
    && pecl install xdebug-2.7.1 \
    && docker-php-ext-enable xdebug

# Install extensions
RUN docker-php-ext-install \
    zip \
    iconv \
    soap \
    sockets \
    intl \
    pdo_mysql \
    exif \
    pcntl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /application
