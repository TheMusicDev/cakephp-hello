FROM themusicdev/php-apache:8.5.12

ENV DEBUG=false
COPY --chown=www-data:www-data . ./
RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && composer dump-autoload -o
