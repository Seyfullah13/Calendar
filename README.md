<p align="center"><a href="https://devdojo.com/wave" target="_blank"><img src="https://cdn.devdojo.com/images/september2023/wave-logo.png" width="200"></a></p>

> If you are looking for a Laravel Starter Kit that uses the Tallstack as well as [Folio](https://laravel.com/docs/folio) and [Volt](https://livewire.laravel.com/docs/volt), you may be interested in checking out [Genesis](https://github.com/thedevdojo/genesis)

<p align="center"><a href="https://github.com/thedevdojo/genesis" target="_blank"><img width="1280" alt="genesis" src="https://github.com/thedevdojo/wave/assets/601261/a5e8aab9-0beb-42d7-be27-12da1ce83699"></a></p>


<p align="center"><a href="https://www.producthunt.com/posts/wave-2-0" target="_blank"><img src="https://cdn.devdojo.com/images/april2021/upvote-product-hunt-img.png" height="auto" width="auto"></a></p>

## Introduction

[Wave](https://devdojo.com/wave) is a Software as a Service Starter Kit that can help you build your next great idea 💰. Wave is built with [Laravel](https://laravel.com), [Voyager](https://voyager.devdojo.com), [TailwindCSS](https://tailwindcss.com), and a few other awesome technologies. Here are some of the awesome features ✨:

 - [Authentication](https://wave.devdojo.com/docs/features/authentication)
 - [User Profiles](https://wave.devdojo.com/docs/features/user-profiles)
 - [User Impersonation](https://wave.devdojo.com/docs/features/user-impersonation)
 - [Subscriptions](https://wave.devdojo.com/docs/features/billing)
 - [Subscription Plans](https://wave.devdojo.com/docs/features/subscription-plans)
 - [User Roles](https://wave.devdojo.com/docs/features/user-roles)
 - [Notifications](https://wave.devdojo.com/docs/features/notifications)
 - [Announcements](https://wave.devdojo.com/docs/features/announcements)
 - [Fully Functional Blog](https://wave.devdojo.com/docs/features/blog)
 - [Out of the Box API](https://wave.devdojo.com/docs/features/api)
 - [Voyager Admin](https://wave.devdojo.com/docs/features/admin)
 - [Customizable Themes](https://wave.devdojo.com/docs/features/themes)


## Demo
View a live [demo here](https://wave.devdojo.com), or deploy your own instance to DigitalOcean, by clicking the button below.

<a href="https://cloud.digitalocean.com/apps/new?repo=https://github.com/thedevdojo/wave/tree/main" target="_blank"><img src="https://www.deploytodo.com/do-btn-blue.svg" width="240" alt="Deploy to DO"></a>

## Installation

Wave runs on **PHP 8.1** and **Laravel 10.x**.

To install Wave, you'll want to clone or download this repo:

```
git clone https://gitlab.6va.eu/myrentproxy/mvp1.git project_name
```

Next, we can install Wave with these **4 simple steps**:

### 1. Create a New Database

We'll need to utilize a MySQL database during the installation. For the following stage, you'll need to create a new database and preserve the credentials.

```sql
CREATE DATABASE wave;
CREATE USER 'wave'@'localhost' IDENTIFIED BY 'wave_password';
GRANT ALL PRIVILEGES ON wave.* TO 'wave'@'localhost';
```

### 2. Copy the `.env.example` file

We need to specify our Environment variables for our application. You will see a file named `.env.example` that is already well configured by other developers, you will need to duplicate that file and rename it to `.env`.

Then, open up the `.env` file and update your *DB_DATABASE*, *DB_USERNAME*, and *DB_PASSWORD* in the appropriate fields. You will also want to update the *APP_URL* to the URL of your application.


### 3. Add Composer Dependencies

First, you should ensure that your web server has the required PHP extensions installed:

> [Laravel PHP Requirements](https://laravel.com/docs/9.x/deployment#server-requirements)

Following that, we'll need to install all composer dependencies through the following command:
```php
composer install
```

### 4. Run Migrations and Seeds

We must migrate our database schema into our database, which we can accomplish by running the following command:
```php
php artisan migrate
```
<br>
Finally, we will need to seed our database with the following command:

```php
php artisan db:seed
```
<br>

🎉 And that's it! You will now be able to visit your URL and see your Wave application up and running.

> Next steps are used for messaging functionality. If you don't use it, you can skip them and start your Wave project 👍
> We'll need to install [Redis](https://redis.io/docs/latest/operate/oss_and_stack/install/install-redis/) before intalling the other dependencies. If you are on Windows, you will also need to install [WSL](https://learn.microsoft.com/en-us/windows/wsl/install) to run GNU/Linux commands on Windows.

### 5. Install Laravel/Passport

We use Laravel/Passport to authenticate users to a Redis Channel. You need to install Passport with the following command. This command will ask you if you want to run the pending migrations, you can answer `no` and remove the `oauth` migrations because we'll not going to use them.

```php
php artisan passport:install
```

We also need to create passport keys to be authenticated properly with Laravel Passport.

```php
php artisan passport:keys
```

And we're all done ! We will need to launch our servers and compile the assets.

### 6. Launch PHP server

```php
php artisan serve
```

### 7. Install Node.js dependencies

Use slashes `/` or anti-slashes `\` according to your OS when navigating through the repositories

```php
cd resources\views\themes\tailwind

npm install
```

### 8. Compile assets

```php
cd resources\views\themes\tailwind

npm run watch
```

### 9. Launch Redis server

If you are on Windows, you have to open a WSL terminal to run this command, since it is a GNU/Linux command

```php
sudo service redis-server start

redis-cli monitor
```

This command should print `OK` if it works

### 10. Launch Laravel-echo-server

```php
cd resources\views\themes\tailwind

npx laravel-echo-server start
```

NB : npx is necessary only if you are on a GNU/Linux distribution. Your terminal may propose you to install the `laravel-echo-server` package before starting it, you can accept.

## Watch, Learn, and Build

We've also got a full video series on how you can setup, build, and configure Wave. 🍿 You can watch first few videos for free, and additional videos will require a [DevDojo Pro](https://devdojo.com/pro) subscription. By subscribing to a [DevDojo Pro](https://devdojo.com/pro) subscription you will also be supporting the ongoing development of this project. It's a win win! 🙌

[Click here to watch the Wave Video Series](https://devdojo.com/course/wave).

[Click here to watch the Laravel documentations](https://laravel.com/docs/10.x/).


## Documentation

Checkout the [official documentation here](https://wave.devdojo.com/docs).
