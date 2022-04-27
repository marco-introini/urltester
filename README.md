# URL Tester

This Laravel project is written for people who want to test Soap Urls protected with x509 Certificates.
I can be used to:
- test on demand single or multiple urls
- cron the test suites

## Installation

- clone the repository
- create database
- create a .env file 
- run migrations: `php artisan migrate:fresh`
- create a user with `php artisan make:filament-user`
- update the user setting is_admin field to true

## ToDos

This will be improved for creating test also for REST APIs

## Contributing

Thank you for considering contributing to URL Tester!

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
