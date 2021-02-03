start: .env
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

phpunit:
	make docker-compose command='exec php php ./vendor/bin/phpunit'

docker-compose: # usage: make docker-compose command='up -d'
	docker-compose \
		--project-directory "$(shell pwd)" \
		--project-name "url-shortner-laravel" \
		--file docker/docker-compose.yml \
		--file docker/docker-compose.local.yml \
		$(command)

phpunit:
	make docker-compose command='exec php php artisan migrate --env=testing'
	make docker-compose command='exec php ./vendor/bin/phpunit'

.env:
	cp .env.example .env

dusk:
	make docker-compose command='exec dusk php artisan migrate --env=dusk.local'
	make docker-compose command='exec dusk php artisan dusk'

yarn-test:
	make docker-compose command='exec node yarn test'