ARG COMPOSE_PROJECT_NAME

FROM node:8-alpine3.11
WORKDIR /app
COPY package.json yarn.lock webpack.mix.js ./
COPY resources ./resources/
RUN yarn install \
    && yarn run production \
    && rm -rf node_modules



FROM ${COMPOSE_PROJECT_NAME}_php
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