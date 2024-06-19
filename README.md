# Exchange Rate Prediction - Admin Panel

## Requirements

>PHP 8.2 or above
>
> MySQL
>
> Composer (Latest)
>
> You can also setup project using docker ignoring all stack requirements

## Setup (Docker)

- Clone this repo:

```bash
git clone {repo_url}
```

- Create your `.env` file:

```bash
cp .env.example .env
```

- Run following command to initialize project:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

- Run Docker containers:

```bash
./vendor/bin/sail up -d
```

- Create database and run migrations:

```bash
./vendor/bin/sail artisan migrate 
```

- Generate encryption key:

```bash
./vendor/bin/sail artisan key:generate
```

- Generate storage link

```bash
./vendor/bin/sail artisan storage:link
```
- Start queue:

```bash
./vendor/bin/sail artisan queue:work
```

- Start scheduler:

```bash
./vendor/bin/sail artisan schedule:work
```

- Default url: `http://localhost`

- To stop the servers use:

```bash
./vendor/bin/sail stop
```

## Setup (Local)

- Clone this repo:

```bash
git clone {repo_url}
```

- Create your `.env` file:

```bash
cp .env.example .env
```

- Setup your php local environment

- Download/Install Composer (Latest Version)

```angular2html
https://getcomposer.org/download/
```

- Create database (MySQL)

```mysql
CREATE DATABASE laravel
```

>>NOTE: you can configure db name and user credentials (also you should apply this configuration in your .env file)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

- Run composer:

```bash
composer install
```

- Generate application encryption key

```bash
php artisan key:generate
```

- Run migrations:

```bash
php artisan migrate 
```

- Generate storage link

```bash
php artisan storage:link
```

- Start queue:

```bash
php artisan queue:work
```

- Start scheduler:

```bash
php artisan schedule:work
```

- Run application

```bash
php artisan serve
```




