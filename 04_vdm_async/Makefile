.PHONY: help up realup down reload ps exec cc build
.PHONY: start-consume1 start-consume2 start-api

default: help

help:
	@echo "Available make commands:\n"; \
	echo  "Docker related:"; \
	echo  "\033[0;32mup\033[0m                      Boots containers (shortcut for docker-compose up)"; \
	echo  "\033[0;32mbuild\033[0m                   Up with build container"; \
	echo  "\033[0;32mdown\033[0m                    Shuts down containers (shortcut for docker-compose down)"; \
	echo  "\033[0;32mrm\033[0m                      Remove stopped containers; \
	echo  "\033[0;32mreload\033[0m                  Runs down + up"; \
	echo  "\033[0;32mexec\033[0m                    Connect to app container"; \
	echo  "\033[0;32mcc\033[0m                      Clear sf cache"; \
	echo  "\033[0;32mlogs\033[0m                    Shows logs (all containers)"; \
	echo  "\033[0;32mstart-api\033[0m               Start local dev server"; \
	echo  "\033[0;32mstart-consume1\033[0m          Start rabbitmq consumption from fanout1 transport"; \
	echo  "\033[0;32mstart-consume2\033[0m          Start rabbitmq consumption from fanout2 transport"; \
	echo  "";

up: realup

realup:
	@docker-compose up -d; \
	echo "\nEnjoy :)\n"

down:
	@docker-compose down --remove-orphans

build:
	@docker-compose up -d --build

rm:
	@docker-compose rm

reload: down up

ps:
	@docker-compose ps

exec:
	@docker exec -it vdm_training_04_app /bin/bash

cc:
	@docker exec -it  vdm_training_04_app bash -c "rm -rf /var/www/html/var/cache/*"

logs:
	@docker-compose logs -f

start-consume1:
	@docker-compose exec -e VDM_APP_NAME=consume1 vdm_training_04_app bin/console messenger:consume fanout1 -v

start-consume2:
	@docker-compose exec -e VDM_APP_NAME=consume2 vdm_training_04_app bin/console messenger:consume fanout2 -v

start-api:
	@echo "\nRunning on your host on http://127.0.0.1:5000 :)\n\n-----------\n\n"; \
	docker-compose exec -e VDM_APP_NAME=api vdm_training_04_app php -S 0.0.0.0:80 -t public/
