FROM php:8.2-apache
# Instala extensões necessárias para e-mail seguro
RUN apt-get update && apt-get install -y libssl-dev && docker-php-ext-install mysqli
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/ && chmod -R 755 /var/www/html/
EXPOSE 80