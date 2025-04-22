FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    wget \
    && rm -rf /var/lib/apt/lists/*

# RUN apt-get install -y libsqlite3-dev ruby-dev msmtp msmtp-mta

RUN a2enmod rewrite

COPY phish.net.conf /etc/apache2/sites-available/phish.net.conf
# COPY ./.htaccess /var/www/html/.htaccess

RUN a2ensite phish.net.conf && a2dissite 000-default.conf

RUN docker-php-ext-install pdo pdo_mysql

RUN chown -R www-data:www-data /var/www/phish.net

ENV UMASK 002

EXPOSE 80 443

CMD ["apache2-foreground"]
