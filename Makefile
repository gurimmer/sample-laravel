install:
	if [ ! -f ./src/.env ]; then cp -p ./src/.env.example ./src/.env; fi
	docker-compose build
	docker-compose run --rm php composer install
	docker-compose run --rm npm install
	docker-compose run --rm npm run dev
	docker-compose run --rm php php artisan key:generate
	docker-compose run --rm php php artisan migrate
	docker-compose run --rm php php artisan db:seed
	echo "\n127.0.0.1 sample-laravel.com\n" | sudo tee -a /etc/hosts
up:
	docker-compose up web php db
destroy:
	docker-compose down --rmi all --volumes
reinstall:
	@make destroy
	@make install
test:
	docker-compose run --rm php composer test
