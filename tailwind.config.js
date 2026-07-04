import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                fcrit: {
                    50: '#FEF2F0',
                    100: '#FDE5E1',
                    200: '#FACCC3',
                    300: '#F5A596',
                    400: '#E8725E',
                    500: '#D14B35',
                    600: '#A73121',
                    700: '#8B2819',
                    800: '#6E2015',
                    900: '#5A1B12',
                },
            },
        },
    },

    plugins: [forms],
};
