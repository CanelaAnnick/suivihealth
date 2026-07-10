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
                navy: {
                    900: '#0B2A4A',
                    800: '#0F3556',
                    700: '#154269',
                },
                teal: {
                    600: '#1C6E8C',
                    500: '#2B87A8',
                },
                coral: {
                    500: '#FF6F61',
                    600: '#E8543F',
                },
                mist: '#EAF4F8',
            },
        },
    },
    plugins: [forms],
};