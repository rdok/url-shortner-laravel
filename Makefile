start: up
	$(info ********************************************************************************)
	$(info               http://localhost:3001             									)

up: .env
	export UID=$$(id -u); export GID=$$(id -g); \
		make docker-compose command='up -d --force-recreate'
	make docker-compose command='exec php composer install'
	make docker-compose command='exec php php artisan migrate'
	make docker-compose command='exec node yarn install'
	make docker-compose command='exec node yarn dev'

logs:
	make docker-compose command="logs -f $(service)"

node-shell:
	make docker-compose command='exec node sh'
php-shell:
	make docker-compose command='exec php sh'

docker-compose: # usage: make docker-compose command='up -d'
	docker-compose \
		--project-directory "$(shell pwd)" \
		--project-name "url-shortner-laravel" \
		--file docker/docker-compose.yml \
		--file docker/docker-compose.local.yml \
		$(command)

phpunit-ci: up
	export UID=$$(id -u); export GID=$$(id -g); \
	make docker-compose command='run --rm php php artisan migrate --env=testing'; \
	make docker-compose command='run --rm php ./vendor/bin/phpunit'

phpunit: db
	export UID=$$(id -u); export GID=$$(id -g); \
	make docker-compose command='run --rm php php artisan migrate --env=testing'; \
	make docker-compose command='run --rm php ./vendor/bin/phpunit'

.env:
	cp .env.example .env

dusk-ci: up
	sleep 15 && make dusk

dusk:
	export UID=$$(id -u); export GID=$$(id -g); \
	make docker-compose command='run --rm dusk bash -c "\
		php artisan dusk:chrome-driver \
        && php artisan migrate --env=dusk.local \
        && php artisan dusk \
	"'

yarn-test-ci: up
	make yarn-test
yarn-test:
	make docker-compose command='exec node yarn test'

db: .env
	export UID=$$(id -u); export GID=$$(id -g); \
	make docker-compose command='up -d db'

down:
	export UID=$$(id -u); export GID=$$(id -g); \
	make docker-compose command='down'

build:
	export UID=$$(id -u); export GID=$$(id -g); \
	make docker-compose command='build'
