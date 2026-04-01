FROM php:8.4-fpm

RUN apt-get update && apt-get install -y unzip git curl ffmpeg libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip opcache exif \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN echo "upload_max_filesize=10M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=12M" >> /usr/local/etc/php/conf.d/uploads.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
