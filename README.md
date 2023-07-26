# Management Panel

A powerful management panel built with Laravel 10 and utilizing the [WebkitX Admin Bootstrap](https://themeforest.net/item/webkitx-admin-bootstrap-admin-dashboard-template-user-interface/27691720) template. The panel allows users to manage customers, products, files, and photos efficiently. It's secured using Laravel Passport for authentication and provides a user-friendly interface in the Persian language.

## Features

- User management: Add, edit, and delete customers with role-based access control.
- Product management: Add, edit, and delete products effortlessly.
- File and Photo management: Upload, organize, and delete files and photos with ease.
- Multilingual Support: Admin panel UI displayed in Persian (Farsi) language for enhanced user experience.
- Secure Authentication: Powered by Laravel Passport for robust and secure user authentication.
- Dashboard: Get an overview of crucial data with graphical representations and charts.
- Search Functionality: Easily find customers, products, files, and photos through the integrated search feature.
- ...

## Requirements

Before setting up the Management Panel, make sure you have the following requirements:

- PHP version X.X (Check Laravel 10 requirements).
- MySQL or any other supported database system.
- Web server (Apache, Nginx, etc.) with PHP support.

## Installation

To install the Management Panel, follow these steps:

1. Clone the repository:

```
git clone git@github.com:reyazat/management-panel.git
```

2. Install dependencies:

```
composer install
```

3. Create a `.env` file:

```
cp .env.example .env
```

4. Generate application key:

```
php artisan key:generate
```

5. Configure the database connection in the `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations and seeders:

```
php artisan migrate --seed
```
## Usage

After successful installation, access the admin panel via the provided URL. Use the credentials created during the seeding process to log in and start managing customers, products, files, and photos.

## Demo

[WebkitX Admin Bootstrap](https://themeforest.net/item/webkitx-admin-bootstrap-admin-dashboard-template-user-interface/27691720)

## Laravel Documentation

For detailed information about Laravel 10, check out the [Laravel documentation](https://laravel.com/docs/10.x).