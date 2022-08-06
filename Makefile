.DEFAULT_GOAL := check

recreate: database-backup
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

deploy:
	clear
	@echo "To be defined"

execute:
	php artisan urltester:execute

clean:
	rm -f database_backup.sql
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear

database-backup:
	/Users/Shared/DBngin/mysql/8.0.27/bin/mysqldump -uroot -S /tmp/mysql_3306.sock urltester > database_backup.sql

database-restore:
	/Users/Shared/DBngin/mysql/8.0.27/bin/mysql -uroot -S /tmp/mysql_3306.sock urltester < database_backup.sql

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