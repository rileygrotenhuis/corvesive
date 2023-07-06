# Corvesive

This is a personal budgeting application built using Laravel and InertiaJS. Corvesive allows you to categorize different "Budgets" to keep track of remaining balances for different types of expenses.

## Installation

1. Clone the repository

   ```bash
   git clone https://github.com/rileygrotenhuis/corvesive.git
   ```

2. Install the Node and Composer dependencies for the application

   ```bash
   cd corvesive
   npm install && composer install
   ```

3. Copy the `.env.example` file as `.env` then update the given variables

   ```bash
   cp .env.example .env
   ```

4. Generate a new encryption key for the Laravel backend application

   ```bash
   php artisan key:generate
   ```

5. Run migrations

   ```bash
   php artisan migrate
   ```

6. Run database seeders (optional)

   ```bash
   php artisan db:seed
   ```

7. Start the backend development server

   ```bash
   php artisan serve
   ```

8. Start the frontend development server in a separate terminal

   ```bash
   npm run dev
   ```

9. Your application will now begin running at http://localhost:8000

## Contributing

All contributions, big or small, are welcome and I appreciate any effort to improve this repository!

View our [Contributing Guide](CONTRIBUTING.md) for more details.

## License

[MIT License](LICENSE.txt)
