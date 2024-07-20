# Laravel 11 Project with Vue.js, Inertia.js, and MySQL

This project is a web application built with Laravel 11, Vue.js, Inertia.js, and MySQL. It includes configuration for creating seeders and a default user.

## Requirements

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL

## Installation

1. Clone the repository:

    ```bash
    git clone 
    cd 
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install Node.js dependencies:

    ```bash
    npm install
    ```

4. Copy the environment file and configure your database:

    ```bash
    cp .env.example .env
    ```

    Edit the `.env` file to configure the connection to your MySQL database:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Run the migrations and seeders:

    ```bash
    php artisan migrate --seed
    ```

    This will create the necessary tables in the database and run the seeders, including creating a default user with the email `admin@admin.com` and password `admin`.

## Usage

To start the development server, run:

```bash
php artisan serve
```

To compile the Vue.js assets, run:
```bash
npm run dev
```

## Commands
Command to create visits
```bash
php artisan app:create-visit
```
