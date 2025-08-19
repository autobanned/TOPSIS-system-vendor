FROM php:8.1-fpm

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy wait script
COPY wait-for-db.sh /wait-for-db.sh
RUN chmod +x /wait-for-db.sh

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Use the wait script as the entrypoint
#ENTRYPOINT ["/wait-for-db.sh", "db", "php-fpm"]

EXPOSE 9000
