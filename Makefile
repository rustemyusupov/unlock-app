dir=${CURDIR}

build:
	@docker build -t php_salto .

start:
	@docker-compose up -d
stop:
	@docker-compose down

restart: stop start

install-project: build start composer-install env fresh install-passport

env:
	cp ./src/.env.example ./src/.env

ssh:
	@docker-compose exec php_salto sh

logs:
	@docker-compose logs --tail=100 -f php_salto

exec:
	@docker run -t -v $(dir)/src:/var/www/html php_salto $$cmd

exec-db:
	@docker run -t -v $(dir)/src:/var/www/html --network $(shell basename $(dir))_salto --link mysql_salto php_salto $$cmd

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

install-passport:
	@make exec-db cmd="php artisan passport:install"

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