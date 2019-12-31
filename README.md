### Development
Only dependency docker & docker-compose

##### Install
```
cp .env.example .env 
source aliases.sh
docker_compose_dev up -d
dcomposer install
dphp artisan migrate
dnpm install
dnpm run dev

# visit http://localhost:3001
```

##### Database
```
dmysql -uroot -psecret
```

**Test**
```
dphp artisan migrate --env=testing
dphp ./vendor/bin/phpunit
ddusk
```

