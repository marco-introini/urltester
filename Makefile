.DEFAULT_GOAL := check

recreate:
	php artisan migrate:fresh --seed
	mysql -u root -h 127.0.0.1 < storage/sql/certificates.sql
	mysql -u root -h 127.0.0.1 < storage/sql/urls.sql

check:
	./vendor/bin/phpstan analyse

delete_certificates:
	rm -f storage/app/certificates/ca/*
	rm -f storage/app/certificates/private/*
	rm -f storage/app/certificates/public/*

test:
	./vendor/bin/pest

first_production:
	composer install
	npm install
	npm run build
	php artisan storage:link

production:
	php artisan down
	git pull
	composer install --prefer-dist --optimize-autoloader
	php artisan migrate
	npm install
	npm run build
	#uncomment if using queues
	#php artisan queue:restart
	php artisan up

execute:
	php artisan urltester:execute

clear:
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear

clear_all: clear
	rm -f database_backup.sql

backup:
	php artisan backup:run

format_code:
	./vendor/bin/pint

update:
	@echo "Current Laravel Version"
	php artisan --version
	@echo "\nUpdating..."
	composer update
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear
	php artisan livewire:discover
	php artisan filament:upgrade
	@echo "UPDATED Laravel Version"
	php artisan --version
	npm update
