# Corvesive - Nuxt

## Prerequisites

Before you can run this application, ensure you have the following software installed on your system:

1. **Node.js**: This application requires Node.js, a JavaScript runtime, to run. You can download and install the latest version of Node.js from the official website: [Node.js Downloads](https://nodejs.org/)

2. **npm (Node Package Manager)**: npm is included with Node.js and is used to manage and install JavaScript packages. Ensure you have the latest version of npm by running the following command in your terminal:

   ```bash
   npm install -g npm@latest
   ```

## Installation

To get started with this application, follow these steps:

1. **Clone the Repository**: Start by cloning this repository to your local machine. You can do this by running the following command in your terminal:

   ```bash
   git clone https://github.com/rileygrotenhuis/nuxt.corvesive.com.git
   ```

2. **Navigate to the Project Directory**: Change your working directory to the newly cloned repository:

   ```bash
   cd nuxt.corvesive.com
   ```

3. **Copy Environment Variables**: This application uses environment variables for configuration. Copy the contents from the `.env.example` file into a `.env` file.

   ```bash
   cp .env.example .egnv
   ```

4. **Install Dependencies**: Now you need to install the project dependencies using npm. Run the following command:

   ```bash
   npm install
   ```

5. **Start the Application**: Once the dependencies are installed, you can start the application by running:

   ```bash
   npm run dev
   ```

## Usage

### Production Preview

To run a preview of what the production environment for this application will look and feel like, you will need to build the application using Vite and then starting the preview environment. You can do this by running the following commands:

```bash
npm run build

npm run preview
```

### Prettier

Prettier is a code formatter that helps maintain consistent code style throughout your project. It automatically formats your code according to a set of predefined rules.

To run Prettier and format your code, run the following command:

```bash
npm run format
```
