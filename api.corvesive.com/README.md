# Corvesive - API

## Prerequisites

Before you can run this application, ensure you have the following software installed on your system:

1. **PHP**: This application requires the latest version of Php to run. You can download and install PHP from the [official website](https://www.php.net/downloads.php). Ensure you have the latest version of PHP by running the following command:

    ```bash
    php --version
    ```

2. **Composer**: Composer is used to manage and install dependencies for PHP. You can download and install Composer from the [official website](https://getcomposer.org/download/). Ensure you have the latest version of Composer by running the following command:

    ```bash
    composer --version
    ```
   
3. **Docker**: This application is containerized by utilizing Docker. You can follow the instructions provided by the Docker team to install it on your machine on their [official documentation](https://docs.docker.com/get-docker/). Ensure you have the latest version of Docker by running the following command:

    ```bash
    docker --version
    ```

4. **Docker Compose**: Docker Compose is a tool used in tandem with Docker for defining and running multi-container Docker applications. You can follow the instructions provided by the Docker team to install it on your machine on their [official documentation](https://docs.docker.com/compose/install/). Ensure you have the latest version of Docker by running the following command:

    ```bash
    docker-compose --version
    ```

## Installation

To get started with this application, follow these steps:

1. **Navigate to the Project Directory**: Change your working directory to the newly cloned repository:

    ```bash
    cd corvesive.com/api.corvesive.com
    ```

2. **Copy Environment Variables**: This application uses environment variables for configuration. Copy the contents from the `.env.example` file into a `.env` file.

    ```bash
    cp .env.example .env
    ```

3. **Install Dependencies**: Now you need to install the project dependencies using Composer. Run the following command:

    ```bash
    composer install
    ```
   
4. **Generate Encryption Key**: To generate an encryption key that the Laravel application uses for authentication and authorization, run the following command:

    ```bash
    php artisan key:generate
    ```
   
5. **Start the Application**: Once the dependencies are installed, you can start the application by running:

    ```bash
    ./vendor/bin/sail up -d
    ```
   
6. **Run Migrations**: To run the database migrations for this application, run the following command:

    ```bash
    ./vendor/bin/sail artisan migrate
    ```
   
## Usage

### PHPUnit

PHPUnit is the PHP testing framework of choice for this application. You will need to create a testing MySQL database to be used by PHPUnit. You can create that testing database within the MySQL Docker container with the following command:

```bash
docker exec -it apicorvesivecom-mysql-1 mysql -p corvesive -e 'create database testing;'
```

Once the testing database has been created, you can run the PHPUnit test suite by running the following command:

```bash
./vendor/bin/sail artisan test
```

### Pint

Pint is Laravel's first-party code formatter that helps maintain consistent code style throughout your project. It automatically formats your code according to a set of predefined rules.

To run Pint and format your code, run the following command:

```bash
./vendor/bin/pint
```

### Telescope

Telescope is a debugging assistant for the Laravel framework. Using the Telescope dashboard (i.e. `/telescope`) you can view and measure multiple metrics from requests, commands, scheduled jobs, logs, and much more.

Telescope if installed and enabled by default but can be disabled if desired by changing the `TELESCOPE_ENABLED` environment variable to `false`.
