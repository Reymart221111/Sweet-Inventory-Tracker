import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                sweetPink: '#F8BBD0',
                sweetBlue: '#BBDEFB',
                sweetYellow: '#FFF9C4',
                sweetOrange: '#FFCCBC',
            },
            fontFamily: {
                heading: ['Pacifico', 'cursive'],
                body: ['Poppins', 'sans-serif'],
            },
            zIndex: {
                '60': '60',
                '70': '70',
                '80': '80',
                '90': '90',
                '100': '100',
                // Add more if needed
            }
        },
    },
    plugins: [],
};
