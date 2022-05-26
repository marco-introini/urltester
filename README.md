# URL Tester

This Laravel/Filament project is written for people who want to test Soap Urls protected with x509 Certificates.
It can be used to:
- test on demand single or multiple urls
- execute the tests via console
- view the results (success and failures)

It uses the cURL functions in PHP.

## Requirements

- PHP >= 8.1
- cURL Extension
- Database (MySQL, PostgreSQL)

## Installation

- clone the repository
- create database
- create a .env file 
- run migrations: `php artisan migrate:fresh`
- create a user with `php artisan make:filament-user`
- update the user setting is_admin field to true
- execute `composer install`
- execute `npm install`
- execute `npm run production`

## Test

```
./vendor/bin/pest
```

## ToDos

- add support for REST APIs
- add cron jobs

## Credits

- [Laravel](https://laravel.com/)
- [FilamentPHP](https://filamentphp.com)

## Contributing

Thank you for considering contributing to URL Tester!

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
