# Multi-stage build for better caching
FROM php:8.2-apache as base

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++ \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    bz2 \
    intl \
    bcmath \
    opcache \
    calendar \
    pdo_mysql \
    mysqli \
    gd

# Install Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Configure Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite headers

# Configure PHP
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "memory_limit = \${PHP_MEMORY_LIMIT:-256M}" >> /usr/local/etc/php/conf.d/memory.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

# Development stage
FROM base as development

# Copy composer file first for better caching (lock file optional)
COPY src/composer.json /var/www/html/

# Install dependencies (including dev for spark CLI)
RUN composer install --optimize-autoloader --no-interaction

# Copy application code
COPY src/ /var/www/html/

# Create user with same UID as host
ARG uid=1000
RUN useradd -G www-data,root -u $uid -d /home/devuser devuser \
    && mkdir -p /home/devuser/.composer \
    && chown -R devuser:devuser /home/devuser

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

# Production stage
FROM base as production

# Copy composer file and install production dependencies (lock file optional)
COPY src/composer.json /var/www/html/
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy application code
COPY src/ /var/www/html/

# Create non-root user for security
RUN useradd -r -s /bin/false -m -d /var/www/html appuser \
    && chown -R appuser:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure for production
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini

EXPOSE 80