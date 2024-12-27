# News Application

The News System is a web application that allows users to latest news from 3 different API source namely the guardian, New York Times and NewsAPI. The application is built using Laravel as the backend framework, which can be use any frontend framewore. It features include news fetch, filtering by categories, source and authors.

## Features

- **Hourly News Fetching**: News articles are automatically fetched every hour using Laravel jobs.
- **Category Management**: Organize news articles into various categories for easier navigation.
- **Filtering**: Filter news articles by categories, source, and author to find relevant content
- **User Authentication**: Secure API authentication using JWT (JSON Web Tokens).
- **Docker Integration**: Dockerized environment for ease of development.
- **API Endpoints**: RESTful API that allows interaction with news articles, categories, sources, and users.

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

- **Docker**: [Install Docker](https://docs.docker.com/get-docker/)
- **Docker Compose**: [Install Docker Compose](https://docs.docker.com/compose/install/)
- **Git**: [Install Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

## Project Setup

Follow these steps to get the Laravel backend application running with Docker:

### Step 1: Clone the Repository

First, clone the repository to your local machine.

```bash
git clone https://github.com/infotrix1/Backend_news.git
cd Backend_news
```

### Step 2: Build the Docker Containers

Run the following command to build and start the Docker containers for the application:

```bash
docker-compose up -d --build
```

This will pull the necessary Docker images, build the application container, and start the backend and database services.

### Step 3: Configure the Environment

Once the containers are up, you need to set up the `.env` file for Laravel.

1. Copy the sample environment file:

```bash
cp .env.example .env
```

2. Open `.env` and configure the database connection and API keys:

```ini
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
GUARDIAN_API_KEY=
NYT_API_KEY=
NEWS_API_KEY=
```

The `DB_HOST` is set to `db` since it refers to the MySQL service running in Docker.

### Step 4: Install Composer Dependencies

Run the following command to install Laravel's PHP dependencies:

```bash
docker-compose exec app composer install
```

### Step 5: Generate the Application Key

Generate the Laravel application key:

```bash
docker-compose exec app php artisan key:generate
```

### Step 6: Migrate the Database

Run database migrations to set up the database schema:

```bash
docker-compose exec app php artisan migrate
```

### Step 7: Access the Application

Once the containers are running, you can access your Laravel application at:

```
http://localhost:8000
```

### Step 8: Docker Containers Management

- To stop the containers:

```bash
docker-compose down
```

- To view logs for the application container:

```bash
docker-compose logs app
```

## Docker Setup

The project uses **Docker** to manage the environment. Here’s a brief description of the services defined in the `docker-compose.yml` file.

### `app` Service (Laravel Application)

This service is responsible for running the Laravel application using PHP and Composer. It uses the `php:8.2-fpm` Docker image.

### `db` Service (MySQL Database)

The MySQL database service runs on port 3306 and is used to store the application's data. It uses the `mysql:5.7` image.

### `nginx` Service (Web Server)

Nginx serves the Laravel application. It listens on port 80.

### Volumes

- **app**: Stores the application code.
- **db_data**: Stores MySQL data files to persist the database.

## Customizing the Docker Setup

You can modify the Docker configuration to fit your needs. For example, you can change the PHP version or use a different database.

### Modify the PHP Version

To use a different PHP version, update the `Dockerfile` under the `app` service to use a different `php` image.

Example:
```dockerfile
FROM php:8.2-fpm
```

### Modify the Database Service

If you'd like to use a different version of MySQL or another database like PostgreSQL, you can modify the `docker-compose.yml` file.

## Additional Information

- Laravel Documentation: [https://laravel.com/docs](https://laravel.com/docs)
- Docker Documentation: [https://docs.docker.com](https://docs.docker.com/)
- Docker Compose Documentation: [https://docs.docker.com/compose/](https://docs.docker.com/compose/)

## Acknowledgements

- The Guardian API: [https://open-platform.theguardian.com/documentation/](https://open-platform.theguardian.com/documentation)
- New York Times API: [https://developer.nytimes.com/docs/articlesearch-product/1/overview](https://developer.nytimes.com/docs/articlesearch-product/1/overview)
- NewsAPI: [https://newsapi.org/](https://newsapi.org/)

## Troubleshooting

If you encounter any issues, here are a few common fixes:

- **Missing `.env` file**: Ensure that you have copied the `.env.example` file to `.env` and updated it as necessary.
- **Docker Compose command not found**: Make sure Docker Compose is installed correctly on your system.
- **Permissions issues**: Ensure the correct file and directory permissions are set for your Laravel project files.

## License

This project is open-source and available under the [MIT License](LICENSE).

---
