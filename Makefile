help:
	@echo 'Run one of the following commands'
	@grep '^[^#[:space:]].*:' Makefile
build:
	docker-compose build

start-local:
	docker-compose up -d

stop-local:
	docker-compose stop

down-local:
	docker-compose down -v --rmi all

rm-local:
	docker-compose rm -f

restart-local:
	$(MAKE) stop-local
	$(MAKE) start-local

composer-install:
	docker-compose run --rm php74-service composer install

migrations-update:
	docker-compose run --rm php74-service php bin/console doctrine:database:drop --if-exists --force 
	docker-compose run --rm php74-service php bin/console doctrine:database:create
	docker-compose run --rm php74-service php bin/console doctrine:migrations:migrate
	docker-compose run --rm php74-service php bin/console doctrine:fixtures:load

init-local:
	$(MAKE) stop-local
	$(MAKE) rm-local
	$(MAKE) build
	$(MAKE) start-local
	$(MAKE) composer-install
	$(MAKE) migrations-update
