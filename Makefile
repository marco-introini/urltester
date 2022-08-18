.DEFAULT_GOAL := check

recreate:
	clear
	rm -f storage/app/certificates/ca/*
	rm -f storage/app/certificates/private/*
	rm -f storage/app/certificates/public/*
	php artisan migrate:fresh --seed
	php artisan make:filament-user

check:
	clear
	./vendor/bin/phpstan analyse

test:
	clear
	./vendor/bin/pest

production:
	clear
	composer install
	npm install
	npm run build
	php artisan storage:link

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
	clear
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