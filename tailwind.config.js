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
                'primaria-like': '#C9A84C',
        'primaria-clear': '#E8C97A',
        'primaria-black': '#A8893A',
        'texto-dark': '#F5F5F0',
        'bg-custom': '#0A0A0A',
        surface: '#181512',
            },
        },
    },

    plugins: [forms],
};

