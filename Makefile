help:
	@echo "\n"
	@echo "пример ввода: \t\033[1;34mmake \033[1;32m{команды}\033[0m"
	@echo "\n"
	@echo "\033[1;33mДоступные команды:\033[0m"
	@echo "\033[1;32mnetwork-create\033[0m\t\t - Создание сети контейнеров"
	@echo "\033[1;32mnetwork-prune\033[0m\t\t - Удаление всех сети контейнеров"
	@echo "\033[1;32mup\033[0m\t\t\t - Поднять докер композ. \033[93mДля локальной разработки\033[0m"
	@echo "\033[1;32mup-build\033[0m\t\t - Обновить образы докера. \033[93mДля локальной разработки\033[0m"
	@echo "\033[1;32mdown\033[0m\t\t\t - Остановить контейнеры. \033[93mДля локальной разработки\033[0m"
	@echo "\033[1;32mdown-clear\033[0m\t\t - Остановить и очистить контейнеры. \033[93mДля локальной разработки\033[0m"
	@echo "\033[1;32mcomposer-update\033[0m\t\t - Обновить все пакеты для LK.\033[0m"
	@echo "\033[1;32mcomposer-install\033[0m\t - Установить все пакеты для LK"
	@echo "\033[1;32mmigrate-up\033[0m\t\t - Накат миграции БД"
	@echo "\033[1;32mmigrate-down\033[0m\t\t - Откат миграции БД"
	@echo "\033[1;32mmodify-dir\033[0m\t\t - Изменение прав доступа к директории"
	@echo "\n"
network-create:
	docker network create ast-network
network-prune:
	docker network rm $(docker network ls -q)
up:
	docker compose up -d
up-build:
	docker compose up -d --build --force-recreate
down:
	docker compose down
down-clear:
	docker compose down -v --remove-orphans
composer-update:
	docker compose run --rm ast-php-cli composer update
composer-install:
	docker compose run --rm ast-php-cli composer install
migrate-up:
	docker compose run --rm ast-php-cli php ./yii migrate -- --interactive=0
migrate-down:
	docker compose run --rm ast-php-cli php ./yii migrate/down all -- --interactive=0
modify-dir:
	docker compose run --rm ast-php-cli chmod 777 -R /app/src/application/api/runtime
	docker compose run --rm ast-php-cli chmod 777 -R /app/src/application/site/runtime
	docker compose run --rm ast-php-cli chmod 777 -R /app/src/application/site/public/assets
	docker compose run --rm ast-php-cli chmod 777 -R /app/src/application/console/runtime
	docker compose run --rm ast-php-cli chmod 777 -R /app/src/FileStorage/tmp_images
	docker compose run --rm ast-php-cli ln -s /app/src/FileStorage/tmp_images /app/src/application/site/public/images
