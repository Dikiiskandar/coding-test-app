# Coding Test App
This README guide will walk you through the steps to run a Laravel project locally on your machine. Laravel is a popular PHP framework known for its elegance and ease of use in building web applications.

## Prerequisites
Before you can run a this project locally, ensure you have the following prerequisites installed on your machine:

- [PHP](https://www.php.net/) (>= 8)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (for Laravel Mix)
- [npm](https://www.npmjs.com/) (for Laravel Mix)
- [MySQL](https://www.mysql.com/)

## Getting Started

1.  Clone the Repository:
    git clone https://github.com/Dikiiskandar/coding-test-app.git
    cd coding-test-app
2.  Install Dependencies:
    composer install
3.  Copy the Environment File:
    cp .env.example .env
    Update the .env file with your database, mail and other environment-specific settings.
4.  Generate an Application Key:
    php artisan key:generate
5.  Run Migrations:
    php artisan migrate
6.  Frontend Assets:
    npm install && npm run build
7.  Start the Development Server:
    php artisan serve
8.  Access the Application: