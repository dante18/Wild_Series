FROM php:7.2
WORKDIR /app
COPY . .
RUN npm encore build
ENTRYPOINT symfony server:start