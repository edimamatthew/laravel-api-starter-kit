# Laravel 7 API Starter Kit

This is a quick starter kit for building APIs on Laravel 7. It contains basic auth setup using Laravel Passport.

## Packages
- Laravel 7
- Laravel Passport

## Endpoints
- https://documenter.getpostman.com/view/18732653/UVR4MpHk

# How to use

## Install

Clone the repo
```
$ git clone https://github.com/edimamatthew/laravel-api-starter-kit
```

Change directory to the cloned repo
```
$ cd laravel-api-starter-kit
```

Install required packages
```
$ composer install
```

Create environment variable
```
cp .env.example .env
```
* Edit the newly created .env file and add your database details

Run migration
```
php artisan migrate
```

Install Laravel Passport
```
php artisan passport:install
```

Start the application
```
php artisan serve
```

Use the provided endpoints in the link above to explore the application and start building.

Cheers!