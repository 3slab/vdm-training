.PHONY: help up realup down reload ps exec cc build
.PHONY: start-dev-consume start-dev-output start-dev-api
.PHONY: start-local-consume

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
	echo  "\033[0;32mstart-dev-api\033[0m           Start local dev server"; \
	echo  "\033[0;32mstart-dev-consume\033[0m       Start rabbitmq consumption from compute transport"; \
	echo  "\033[0;32mstart-dev-output\033[0m        Start rabbitmq consumption from queue output_queue"; \
	echo  "\033[0;32mstart-local-consume\033[0m     Start rabbitmq consumption from compute transport in local env"; \
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
	@docker exec -it vdm_training_05_app /bin/bash

cc:
	@docker exec -it  vdm_training_05_app bash -c "rm -rf /var/www/html/var/cache/*"

logs:
	@docker-compose logs -f

start-dev-consume:
	@docker-compose exec -e VDM_APP_NAME=compute -e APP_ENV=dev -e VDM_PRINT_MSG=true vdm_training_05_app bin/console messenger:consume compute -vv

start-dev-output:
	@docker-compose exec -e VDM_APP_NAME=output -e APP_ENV=dev vdm_training_05_app bin/console messenger:consume output -v

start-dev-api:
	@echo "\nRunning on your host on http://127.0.0.1:5000 :)\n\n-----------\n\n"; \
	docker-compose exec -e VDM_APP_NAME=api -e APP_ENV=dev vdm_training_05_app php -S 0.0.0.0:80 -t public/

start-local-consume:
	@docker-compose exec -e VDM_APP_NAME=compute -e APP_ENV=local vdm_training_05_app bin/console messenger:consume compute -vv && \
	docker-compose exec vdm_training_05_app cat /var/www/html/local/output.json