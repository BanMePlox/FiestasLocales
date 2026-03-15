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
                sans:    ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                accent: {
                    DEFAULT: '#b91c1c',
                    hover:   '#991b1b',
                    subtle:  '#fee2e2',
                    text:    '#7f1d1d',
                },
            },
            fontSize: {
                '2xs': ['0.65rem', { lineHeight: '1rem' }],
            },
        },
    },

    plugins: [forms],
};
