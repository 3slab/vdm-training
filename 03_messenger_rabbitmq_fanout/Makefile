.PHONY: help up realup down reload ps exec build
.PHONY: start-async-consume1 start-async-consume2 start-async-api
.PHONY: start-fanout-consume1 start-fanout-consume2 start-fanout-api
.PHONY: start-kafka-consume1 start-kafka-consume2 start-kafka-api exec-kafka-create-topic

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
	echo  "\033[0;32mlogs\033[0m                    Shows logs (all containers)"; \
	echo  "\033[0;32mstart-async-api\033[0m         Start local dev server in async env"; \
	echo  "\033[0;32mstart-async-consume1\033[0m    Start rabbitmq consumption from async1 transport in async env"; \
	echo  "\033[0;32mstart-async-consume2\033[0m    Start rabbitmq consumption from async2 transport in async env"; \
	echo  "\033[0;32mstart-fanout-api\033[0m        Start local dev server in fanout env"; \
	echo  "\033[0;32mstart-fanout-consume1\033[0m   Start rabbitmq consumption from fanout1 transport in fanout env"; \
	echo  "\033[0;32mstart-fanout-consume2\033[0m   Start rabbitmq consumption from fanout2 transport in fanout env"; \
	echo  "\033[0;32mstart-kafka-api\033[0m         Start local dev server in kafka env"; \
	echo  "\033[0;32mstart-kafka-consume1\033[0m    Start kafka consumption from fanout1 transport in kafka env"; \
	echo  "\033[0;32mstart-kafka-consume2\033[0m    Start kafka consumption from fanout2 transport in kafka env"; \
	echo  "\033[0;32exec-kafka-create-topic\033[0m  Create topic vdm_action in kafka"; \
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
	@docker exec -it vdm_training_03_messenger /bin/bash

logs:
	@docker-compose logs -f

start-async-consume1:
	@docker-compose exec vdm_training_03_messenger bin/console --env=async messenger:consume async1 -v

start-async-consume2:
	@docker-compose exec vdm_training_03_messenger bin/console --env=async messenger:consume async2 -v

start-async-api:
	@echo "\nRunning on your host on http://127.0.0.1:5000 :)\n\n-----------\n\n"; \
	docker-compose exec -e APP_ENV=async vdm_training_03_messenger php -S 0.0.0.0:80 -t public/

start-fanout-consume1:
	@docker-compose exec vdm_training_03_messenger bin/console --env=fanout messenger:consume fanout1 -v

start-fanout-consume2:
	@docker-compose exec vdm_training_03_messenger bin/console --env=fanout messenger:consume fanout2 -v

start-fanout-api:
	@echo "\nRunning on your host on http://127.0.0.1:5000 :)\n\n-----------\n\n"; \
	docker-compose exec -e APP_ENV=fanout vdm_training_03_messenger php -S 0.0.0.0:80 -t public/

exec-kafka-create-topic:
	@docker-compose exec vdm_training_03_kafka kafka-topics --create --if-not-exists --bootstrap-server vdm_training_03_kafka:29092 --replication-factor 1 --partitions 1 --topic vdm_action

start-kafka-consume1:
	@docker-compose exec vdm_training_03_messenger bin/console --env=kafka messenger:consume fanout1 -v

start-kafka-consume2:
	@docker-compose exec vdm_training_03_messenger bin/console --env=kafka messenger:consume fanout2 -v

start-kafka-api:
	@echo "\nRunning on your host on http://127.0.0.1:5000 :)\n\n-----------\n\n"; \
	docker-compose exec -e APP_ENV=kafka vdm_training_03_messenger php -S 0.0.0.0:80 -t public/