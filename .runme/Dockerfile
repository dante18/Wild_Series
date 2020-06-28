FROM php:7.2
WORKDIR /app
COPY . .
RUN yarn encore build
ENTRYPOINT symfony server:start