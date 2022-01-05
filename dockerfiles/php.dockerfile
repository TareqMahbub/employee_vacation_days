FROM composer as vendor

WORKDIR /

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM php

COPY . /
COPY --from=vendor /vendor/ /vendor

RUN chown -R www-data:www-data /public
RUN chown -R www-data:www-data /storage
