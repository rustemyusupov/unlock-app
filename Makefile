dir=${CURDIR}

build:
	@docker build -t php .

start:
	@docker-compose up -d
stop:
	@docker-compose down

restart: stop start

env:
	cp ./.env.local ./.env

ssh:
	@docker-compose exec php sh

logs:
	@docker-compose logs --tail=100 -f php

exec:
	@docker run -t -v $(dir)/src:/var/www/html php $$cmd

exec-db:
	@docker run -t -v $(dir)/src:/var/www/html --network salto_salto --link mysql php $$cmd

composer-install:
	@make exec cmd="composer install"

composer-update:
	@make exec cmd="composer update"

migrate:
	@make exec-db cmd="php artisan migrate"

seed:
	@make exec-db cmd="php artisan db:seed"

fresh:
	@make exec-db cmd="php artisan migrate:fresh --seed"

phpunit:
	@make exec-db cmd="vendor/bin/phpunit"

phpcs:
	@make exec cmd="vendor/bin/phpcs . --standard=PSR2 --ignore=vendor,database"

phpcbf:
	@make exec cmd="vendor/bin/phpcbf . --standard=PSR2 --ignore=vendor"

phpmd:
	@make exec cmd="vendor/bin/phpmd app,tests json codesize,unusedcode,naming"

phpcpd:
	@make exec cmd="vendor/bin/phpcpd app"