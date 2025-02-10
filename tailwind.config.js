import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // Permite alternar manualmente entre claro e escuro
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        'bg-red-500', 'border-red-400', 'bg-red-100', 'text-red-700',
        'bg-yellow-500', 'border-yellow-400', 'bg-yellow-100', 'text-yellow-700'
    ],
    theme: {
        extend: {
            fontFamily: {
                ubuntu: ["Ubuntu", "sans-serif"],
            },
        },
    },
    plugins: [forms],
};
