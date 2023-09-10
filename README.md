# Coding Test App
**Example Site:**[https://coding-test-app.masdeclara.com](https://coding-test-app.masdeclara.com)

**Code Style:**
"In our JavaScript files, we adhere to the Airbnb JavaScript code style guide, which furnishes a comprehensive set of rules and conventions aimed at crafting clean and easily maintainable JavaScript code."

**CI/CD Pipeline Choice:**
"For the specific needs of this project, we have established a workflow using GitHub Actions. This decision is in direct alignment with the project's requirements, as GitHub Actions offers a robust suite of features designed to automate our build, test, and deployment procedures."

## Prerequisites
Before you can run a this project locally, ensure you have the following prerequisites installed on your machine:

- [PHP](https://www.php.net/) (>= 8.1)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (for Laravel Mix)
- [npm](https://www.npmjs.com/) (for Laravel Mix)
- [MySQL](https://www.mysql.com/)

## Getting Started

1.  **Clone the Repository:**
```
git clone https://github.com/Dikiiskandar/coding-test-app.git
cd coding-test-app
```
2.  **Install Dependencies:**
```
composer install
```
3.  **Copy the Environment File:**
```
cp .env.example .env
```
> Update the .env file with your database, mail and other environment-specific settings.
4.  **Generate an Application Key:**
```
php artisan key:generate
```
5.  **Generate Storage Link:**
```
php artisan storage:link
```
6.  **Run Migrations:**
```
php artisan migrate --seed
```
7.  **Frontend Assets:**
```
npm install 
npm run build
```
8.  **Start the Development Server:**
```
php artisan serve
```
>This will start the server at [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Testing
### Running tests for the "product" group
```
php artisan test --group product
```
>This command will execute only the tests associated with the "product" group

### Running all tests

```
php artisan test
```
>This command will execute all tests