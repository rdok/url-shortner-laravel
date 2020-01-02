#!/bin/bash

PROJECT_NAME='url-shortner-laravel'

docker_compose_dev() {
    docker-compose \
        --project-directory "$(pwd)" \
        --project-name "${PROJECT_NAME}" \
        --file docker/docker-compose.yml \
        --file docker/docker-compose.local.yml \
        "$@"
}

dphp() {
    docker_compose_dev exec php php "$@"
}

dpt() {
    docker_compose_dev exec php php ./vendor/bin/phpunit "$@"
}

dcomposer() {
    docker_compose_dev exec php composer "$@"
}

dmysql() {
    docker_compose_dev exec db mysql "$@"
}

dyarn() {
    docker run \
        --rm \
        --name "${PROJECT_NAME}_npm-dev" \
        --volume "/$(pwd)":"//app" \
        --workdir //app \
        -it \
        node:8-alpine3.11 yarn \
        "$@"
}

ddusk() {
  docker_compose_dev run --rm dusk php artisan dusk "$@"
}
