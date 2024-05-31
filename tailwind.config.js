import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins'],
            },
            screens: {
                'xs': '375px',
            },
            colors: {
                primary: {
                    100: '#F0E6F9',
                    200: '#E5D2F3',
                    300: '#D5B6EB',
                    400: '#C898E1',
                    500: '#BE7FD5',
                    600: '#B265C6',
                    700: '#9E54AE',
                    800: '#80468D',
                    900: '#663E71',
                    950: '#2B1A2F',
                    1000: '#1E1323',
                },
            }
        },
    },

    plugins: [forms],
};
