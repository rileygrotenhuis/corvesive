# api.corvesive.com

This is the API for Corvesive built using Laravel.

## Installation

1. Install dependencies

    ```bash
    composer install
    ```

2. Copy the `.env.example` file as `.env` then update the given variables

    ```bash
    cp .env.example .env
    ```

3. Generage a new encryption key for the Laravel application

    ```bash
    php artisan key:generage
    ```

4. Start the Docker environment using Laravel Sail

    ```bash
    ./vendor/bin/sail up -d
    ```
   
> Note: It's helpful to add a terminal alias so that you can just use `sail` and avoid the filepath extensions.

5. Run migrations

    ```bash
    sail artisan migrate
    ```
   
## Usage

### PhpUnit Testing

We use the PhpUnit testing framework for E2E feature tests and unit tests. You will need to create a testing MySQL database to be used by PhpUnit. You can create that testing database by running:

```bash
docker exec -it apicorvesivecom-mysql-1 mysql -p corvesive -e 'create database testing;'
```

One you can have created the testing MySQL database, you can run the tests using:

```bash
sail artisan test
```
   
### Laravel Pint

To maintain a consistent code style for easy readability we utilize Laravel Pint. To format your development environment, run:

```bash
./vendor/bin/pint
```

## Contributions

All contributions, big or small, are welcome and I appreciate any effort to improve this repository and this project!

View our [Contributing Guide](CONTRIBUTING.md) for more details.

## License

[MIT License](LICENSE.txt)
