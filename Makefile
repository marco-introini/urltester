recreate:
	clear
	@echo "Recreation is not recommended for this project"
	rm -f storage/app/certificates/ca/*
	# rm -f storage/app/certificates/private/*
	# rm -f storage/app/certificates/public/*
	#php artisan migrate:fresh --seed

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