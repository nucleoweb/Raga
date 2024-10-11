import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const defaultTheme = require('tailwindcss/defaultTheme');

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
                sans: ['Lato', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'header': '0px 4px 30px 0px rgba(230, 229, 234, 0.75);',
                'login': '8px 8px 30px 0px rgba(0, 0, 0, 0.28);'
            },
            backgroundImage: {
                'home-hero': "url('/public/img/home-bg.png')",
            },
        },
    },

    plugins: [forms],
};
