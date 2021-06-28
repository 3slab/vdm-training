.PHONY: help up realup down reload ps exec cc build

default: help

help:
	@echo "Available make commands:\n"; \
	echo  "Docker related:"; \
	echo  "\033[0;32mup\033[0m                    Boots containers (shortcut for docker-compose up)"; \
	echo  "\033[0;32mbuild\033[0m                 Up with build container"; \
	echo  "\033[0;32mdown\033[0m                  Shuts down containers (shortcut for docker-compose down)"; \
	echo  "\033[0;32mrm\033[0m                    Remove stopped containers; \
	echo  "\033[0;32mreload\033[0m                Runs down + up"; \
	echo  "\033[0;32mexec\033[0m                  Connect to app container"; \
	echo  "\033[0;32mcc\033[0m                    Clear sf cache"; \
	echo  "\033[0;32mlogs\033[0m                  Shows logs (all containers)"; \
	echo  "\033[0;32mstart\033[0m                 Start local dev server"; \
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
	@docker exec -it vdm_training_01_app /bin/bash

cc:
	@docker exec -it vdm_training_01_app bash -c "rm -rf /var/www/html/var/cache/*"

logs:
	@docker-compose logs -f

start:
	@echo "\nRunning on your host on http://127.0.0.1:5000 :)\n\n-----------\n\n"; \
	docker-compose exec vdm_training_01_app php -S 0.0.0.0:80 -t public/;
