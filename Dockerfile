FROM php:8.2-apache

RUN apt-get update && apt-get install -y socat

RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

RUN a2enmod headers

CMD socat TCP-LISTEN:3306,fork TCP:mariadb:3306 & apache2-foreground