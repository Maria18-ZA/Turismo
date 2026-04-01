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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primaria':       '#b5600a',
                'primaria-dark':  '#7c3a00',
                'primaria-light': '#d4880c',
                'acento':         '#ffd580',
                'fundo-secao':    '#fff7ef',
                'fundo-hero':     '#fff7e0',
                'texto-escuro':   '#5c2800',
                'texto-medio':    '#997755',
                'borda-card':     '#edd8b8',
            },
        },
    },

    plugins: [forms],
};

