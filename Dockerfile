FROM php:8.2-apache

# Installer des outils utiles
RUN apt-get update && apt-get install -y \
    git \
    curl \
    wget \
    && rm -rf /var/lib/apt/lists/*

# Activer mod_rewrite pour le .htaccess
RUN a2enmod rewrite

# Copier la configuration Apache custom
COPY phish.net.conf /etc/apache2/sites-available/phish.net.conf

# Activer le site et désactiver le site par défaut
RUN a2ensite phish.net.conf && a2dissite 000-default.conf

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Exposer les ports (par défaut, Apache écoute sur 80)
EXPOSE 80 443

# Lancer Apache au démarrage du container
CMD ["apache2-foreground"]
