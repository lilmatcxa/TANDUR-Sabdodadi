import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                tandur1: '#15B392',
                tandur2: '#73EC8B',
                tandur3: '#D2FF72',
                tandur4: '#54C392',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                    '50%': { transform: 'translateY(-20px) rotate(5deg)' },
                },
                'float-delayed': {
                    '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                    '50%': { transform: 'translateY(-15px) rotate(-3deg)' },
                },
                'float-slow': {
                    '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                    '50%': { transform: 'translateY(-10px) rotate(2deg)' },
                },
                shimmer: {
                    '0%': { transform: 'translateX(-100%) skewX(-12deg)' },
                    '100%': { transform: 'translateX(200%) skewX(-12deg)' },
                },
                'fade-in-up': {
                    from: { opacity: '0', transform: 'translateY(30px)' },
                    to: { opacity: '1', transform: 'translateY(0)' },
                },
                'fade-in': {
                    from: { opacity: '0' },
                    to: { opacity: '1' },
                },
                'pulse-slow': {
                    '0%, 100%': { opacity: '1' },
                    '50%': { opacity: '0.7' },
                },
                'count-up': {
                    from: { opacity: '0', transform: 'scale(0.5)' },
                    to: { opacity: '1', transform: 'scale(1)' },
                },
            },
            animation: {
                float: 'float 6s ease-in-out infinite',
                'float-delayed': 'float-delayed 8s ease-in-out infinite',
                'float-slow': 'float-slow 10s ease-in-out infinite',
                shimmer: 'shimmer 1.5s ease-in-out infinite',
                'fade-in-up': 'fade-in-up 0.7s ease-out',
                'fade-in': 'fade-in 1.2s ease-out',
                'pulse-slow': 'pulse-slow 3s ease-in-out infinite',
                'count-up': 'count-up 1s ease-out',
            },
        },
    },

    safelist: [
        {
            pattern: /bg-(green|lime|yellow|orange)-100/,
        },
        {
            pattern: /text-(green|lime|yellow|orange)-(600|800)/,
        },
        {
            pattern: /border-(green|lime|yellow|orange)-100/,
        },
        {
            pattern: /(bg|text|border)-(green|yellow|lime|orange|amber|blue)-(100|600|800)/,
        },
        {
            pattern: /bg-(tandur1|tandur2|tandur3|tandur4)(\/\d+)?/,
        },
        {
            pattern: /text-(tandur1|tandur2|tandur3|tandur4)/,
        },
        {
            pattern: /border-(tandur1|tandur2|tandur3|tandur4)(\/\d+)?/,
        },
    ],

    plugins: [forms],
}
