# Set the base image
FROM php:8.2-fpm
# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    vim -y \
    libxml2-dev \
    zlib1g-dev

RUN sed -i 's/memory_limit = 128M/memory_limit = 1G/g' /usr/local/etc/php/php.ini-production
RUN sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 1024M/g' /usr/local/etc/php/php.ini-production
RUN sed -i 's/max_execution_time = 30/max_execution_time = 120/g' /usr/local/etc/php/php.ini-production

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd iconv zip  xml simplexml
RUN apt-get update \
    && apt-get install -y libxml2-dev \
    && export EXTRA_CFLAGS="-I/usr/src/php" \
    && docker-php-ext-install xmlreader

# Install Node.js 22
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Set the working directory
WORKDIR /var/www/html
