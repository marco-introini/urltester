recreate: database-backup
	clear
	rm -f storage/app/certificates/ca/*
	rm -f storage/app/certificates/private/*
	rm -f storage/app/certificates/public/*
	php artisan migrate:fresh --seed

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

database-backup:
	/Users/Shared/DBngin/mysql/8.0.27/bin/mysqldump -uroot -S /tmp/mysql_3306.sock urltester > database_backup.sql

database-restore:
	/Users/Shared/DBngin/mysql/8.0.27/bin/mysql -uroot -S /tmp/mysql_3306.sock urltester < database_backup.sql