### URL Shortner Laravel
[![Build Status](https://jenkins.rdok.dev/buildStatus/icon?job=url-shortner-laravel%2Frelease)](https://jenkins.rdok.dev/job/url-shortner-laravel/job/release/)

### Development
Only dependency docker & docker-compose

##### Install
```
cp .env.example .env 
# If your 'id -u' is not 1000, then update UID & GID

source aliases.sh
docker_compose_dev up -d
dcomposer install
dphp artisan migrate
dyarn install
dyarn run dev

# visit http://localhost:3001
```

##### Database
```
dmysql -uroot -psecret
```

**Test**
```
dyarn install
dyarn run test

dphp artisan migrate --env=testing
dphp ./vendor/bin/phpunit

dphp artisan migrate --env=dusk.local
ddusk php artisan dusk:chrome-driver
ddusk php artisan dusk
```

