FROM php:7.2
WORKDIR /app
COPY . .
RUN composer install
ENTRYPOINT yarn encore dev