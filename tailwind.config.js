import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
    content: [
        'node_modules/preline/dist/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            animation: {
                'left': 'left 1.3s ease',
                'right': 'right 1.3s ease',
                'left-label': 'left-label 1.7s ease',
                'right-label': 'right-label 1.7s ease',
                'bottom': 'bottom 1.3s ease',
                'top': 'top 1.3s ease',
                'footer': 'footer 1.4s ease',
                'span1': 'span1 1.7s ease',
                'span2': 'span2 1.9s ease',
                'span3': 'span3 2s ease',
              },
              keyframes: {
                'left': {
                  '0%': { transform: 'translateX(-400px)', opacity: 0 },
                  '100%': { transform: 'translateX(0)', opacity: 1 },
                },
                'left-label': {
                  '0%': { transform: 'translateX(-400px)', opacity: 0 },
                  '100%': { transform: 'translateX(0)', opacity: 1 },
                },
                'right': {
                  '0%': { transform: 'translateX(400px)', opacity: 0 },
                  '100%': { transform: 'translateX(0)', opacity: 1 },
                },
                'right-label': {
                  '0%': { transform: 'translateX(400px)', opacity: 0 },
                  '100%': { transform: 'translateX(0)', opacity: 1 },
                },
                'bottom': {
                  '0%': { transform: 'translateY(400px)', opacity: 0 },
                  '100%': { transform: 'translateY(0)', opacity: 1 },
                },
                'top': {
                  '0%': { transform: 'translateY(-400px)', opacity: 0 },
                  '100%': { transform: 'translateY(0)', opacity: 1 },
                },
                'footer': {
                  '0%': { transform: 'translateY(400px) scale(5)', opacity: 0 },
                  '100%': { transform: 'translateY(0) scale(1)', opacity: 1 },
                },
                'span1': {
                  '0%': { transform: 'translateY(400px) scale(5)', opacity: 0 },
                  '100%': { transform: 'translateY(0) scale(1)', opacity: 1 },
                },
                'span2': {
                  '0%': { transform: 'translateY(400px) scale(5)', opacity: 0 },
                  '100%': { transform: 'translateY(0) scale(1)', opacity: 1 },
                },
                'span3': {
                  '0%': { transform: 'translateY(400px) scale(5)', opacity: 0 },
                  '100%': { transform: 'translateY(0) scale(1)', opacity: 1 },
                },
            },
            fontFamily: {
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
                'poppins': 'Poppins',
                'space-grostesk': 'Space Grotesk',
            },
        },
    },
    plugins: [
        require('preline/plugin'),
    ],
};
