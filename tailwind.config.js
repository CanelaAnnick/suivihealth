import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                display: ['Fraunces', ...defaultTheme.fontFamily.serif],
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                navy: { 900: '#0B3A66', 800: '#0F4A82', 700: '#145C9E' },
                teal: { 600: '#1E9E6B', 500: '#2DBB82' },
                coral: { 500: '#4CC98A', 600: '#34A873' },
                mist: '#F2F9F7',
            },
        },
    },
    plugins: [forms],
};