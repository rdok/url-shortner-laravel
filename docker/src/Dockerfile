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