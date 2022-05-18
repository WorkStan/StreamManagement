init: down-clear pull build up app-init npm-init

front-init: frontend-init restart

restart:
	docker compose restart

up:
	docker compose up -d

down:
	docker compose down --remove-orphans

pull:
	docker compose pull

build:
	docker compose build --pull

down-clear:
	docker compose down --remove-orphans --volumes

app-init: composer-install copy-env key-generate make-link migrate

migrate:
	docker compose run --rm backend-php-cli php artisan migrate

composer-install:
	docker compose run --rm backend-php-cli composer install

composer-dump:
	docker compose run --rm backend-php-cli composer dump-autoload

copy-env:
	docker compose run --rm backend-php-cli composer run post-root-package-install

key-generate:
	docker compose run --rm backend-php-cli php artisan key:generate

permissions:
	sudo chmod -R ug+rwx backend/storage backend/bootstrap/cache
	sudo chgrp -R 82 backend/storage backend/bootstrap/cache

make-link:
	docker compose run --rm backend-php-cli php artisan storage:link

npm-init: npm-install npm-build-dev

npm-install:
	docker compose run --rm app-nodejs npm install

npm-build-dev:
	docker compose run --rm app-nodejs npm run dev
