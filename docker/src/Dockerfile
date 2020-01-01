ARG DOCKER_REPO

FROM node:8-alpine3.11
WORKDIR /app
COPY package.json package-lock.json webpack.mix.js ./
COPY resources ./resources/
RUN npm install \
    && npm run production \
    && rm -rf node_modules



FROM ${DOCKER_REPO}:php
#FROM rdok/url-shortner-laravel:php
WORKDIR /app
COPY composer.lock composer.json artisan ./
COPY app ./app/
COPY bootstrap ./bootstrap/
COPY config ./config/
COPY database ./database/
COPY public ./public/
COPY resources ./resources/
COPY routes ./routes/
COPY storage ./storage/
RUN composer install --no-progress --no-dev --no-suggest \
        --optimize-autoloader --no-interaction \
    && composer clear-cache

COPY . .
COPY --from=0 /app/public ./public/