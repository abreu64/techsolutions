FROM php:8.2-apache

# Instala dependências de sistema e extensões para e-mail seguro
RUN apt-get update && apt-get install -y \
    libssl-dev \
    unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

# Instala o PHPMailer automaticamente
RUN composer require phpmailer/phpmailer

RUN chown -R www-data:www-data /var/www/html/ && chmod -R 755 /var/www/html/

EXPOSE 80