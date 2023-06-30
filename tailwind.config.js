const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                roboto : ['Roboto', 'sans-serif'],
                kanit : ['Kanit','sans-serif'],
                Pt : ['PT Serif', 'serif'],
                Libre : [ 'Libre Baskerville', 'serif']
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
                SeparateBorder :"var(--SeparateBorder)",
                BackdropBg : "var(--BackdropBg)",
                ButtonBg : "var(--ButtonBg)",
                ButtonFocus : "var(--ButtonFocus)",
                ButtonBorder : "var(--ButtonBorder)",
            }
        },
    },

    plugins: [
    require('@tailwindcss/forms'),
    require("daisyui"),
 require('flowbite/plugin')],
};
