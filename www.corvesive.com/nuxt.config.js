export default defineNuxtConfig({
  devtools: { enabled: true },
  css: ['~/assets/main.css'],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {}
    }
  },
  runtimeConfig: {
    public: {
      apiUrl: process.env.VITE_API_URL,
      analyticsEnabled: process.env.VITE_ANALYTICS_ENABLED
    }
  },
  modules: ['@pinia/nuxt']
});
