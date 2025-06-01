FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    curl \
    wget \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY phish.net.conf /etc/apache2/sites-available/phish.net.conf

RUN a2ensite phish.net.conf && a2dissite 000-default.conf

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

EXPOSE 80 443

CMD ["apache2-foreground"]
