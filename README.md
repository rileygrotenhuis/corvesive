# Daily Allowance

This is a Next.js application built with Prisma and Material UI that allows you to set yourself a daily allowance and track how much money you have left for a given day by entering in your daily transactions.

## Installation

1. Clone the repository

   ```bash
   git clone https://github.com/rileygrotenhuis/daily-allowance.git
   ```

2. Install dependencies

   ```bash
   cd daily-allowance
   npm install
   ```

3. Copy the `.env.example` file as `.env.local` and `.env` then update the given variables

   ```bash
   cp .env.example .env.local
   cp .env.example .env
   ```

4. Run migrations

   ```bas
   npm run prisma:migrate
   ```

5. Start the development server

   ```
   npm run dev
   ```

6. Your application will now begin running at http://localhost:3000

## Contributing

All contributions, big or small, are welcome and I appreciate any effort to improve this repository!

View our [Contributing Guide](CONTRIBUTING.md) for more details.

## License

[MIT License](LICENSE.txt)
