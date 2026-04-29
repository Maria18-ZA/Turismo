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
                'primaria':       '#1e5799',
                'primaria-dark':  '#2980b9',
                'primaria-light': '#0f2744',
                'acento':         '#7ec8e3',
                'fundo-secao':    '#f4f6f8',
                'fundo-hero':     '#1a2a3a',
                'texto-escuro':   '#5c2800',
                'texto-medio':    '#997755',
                'borda-card':     '#edd8b8',
                'primaria-like': '#C9A84C',
        
            },
        },
    },

    plugins: [forms],
};

