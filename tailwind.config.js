const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
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
                PrimaryBg : 'var(--PrimaryBg)',
                PrimaryText : 'var(--PrimaryText)',
                SecondaryBg : 'var(--SecondaryBg)',
                SecondaryText : 'var(--SecondaryText)',
                HoverBg : 'var(--HoverBg)',
                HoverText : 'var(--HoverText)',
                SoftBg : 'var(--SoftBg)',
                SoftText : 'var(--SoftText)',
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
