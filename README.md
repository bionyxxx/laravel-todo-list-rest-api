<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Todo List Rest API

This is a simple todo list rest api built with laravel 10 and mysql database.

## Installation

Clone the repository-

```
git clone https://github.com/bionyxxx/laravel-todo-list-rest-api.git
```

Then cd into the folder with this command-

```
cd laravel-todo-list-rest-api
```

Then do a composer install

```
composer install
```

Then create a environment file using this command-

```
cp .env.example .env
```

Then provide the database details in the .env file like this-

```
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Then create a database named `todo_list` and then do a database migration using this command-

```
php artisan migrate
```

Then start the server using this command-

```
php artisan serve
```

Postman Documentation
https://documenter.getpostman.com/view/8754184/2s9YCBsoje
