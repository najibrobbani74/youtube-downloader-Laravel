FROM php:8.1-cli-alpine

ENV \
    APP_DIR="/app"\
    App_PORT="8000"

COPY . ${APP_DIR}

COPY .env.example ${APP_DIR}/.env

RUN apk add --update \
    curl \
    php \
    php-opcache \
    php-openssl \
    php-pdo \
    php-json \
    php-phar \
    php-dom \
    && rm -rf /var/cache/apk/*

RUN curl -s https://getcomposer.org/installer | php --\
    --install-dir=/usr/bin --filename=composer

RUN cd ${APP_DIR} && composer update
RUN cd ${APP_DIR} && php artisan key:generate

WORKDIR ${APP_DIR}

CMD php artisan serve --host=0.0.0.0 --port=${App_PORT}

EXPOSE ${App_PORT}