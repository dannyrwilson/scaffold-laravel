FROM ubuntu:16.04

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y software-properties-common

RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php

RUN apt-get update

RUN apt-get install -y git php7.1-cli php7.1-curl php7.1-gd php7.1-mbstring php7.1-mysql php7.1-sqlite php7.1-xml php7.1-zip

RUN echo "Europe/London" | tee /etc/timezone
RUN dpkg-reconfigure --frontend noninteractive tzdata

COPY ./docker/common/composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

COPY ./docker/common/phpunit-7.phar /usr/local/bin/phpunit
RUN chmod +x /usr/local/bin/phpunit

RUN mkdir /var/www
WORKDIR /var/www

RUN echo alias artisan=\"/usr/bin/php /var/www/artisan\" >> /etc/bash.bashrc

ENTRYPOINT ["/bin/true"]
