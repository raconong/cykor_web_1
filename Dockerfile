FROM php:8.1-apache


RUN apt-get update \
 && apt-get install -y default-mysql-client \
 && docker-php-ext-install mysqli


COPY . /var/www/html/



COPY entry.sh /entry.sh
RUN chmod +x /entry.sh

ENTRYPOINT ["/entry.sh"]