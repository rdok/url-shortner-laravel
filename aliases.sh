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
    dnode yarn "$@"
}

dnode() {
    docker_compose_dev exec node "$@"
}

ddusk() {
  docker_compose_dev exec dusk "$@"
}

dphp() {
    docker_compose_dev exec php php "$@"
}

app() {
    docker_compose_dev exec php "$@"
}

