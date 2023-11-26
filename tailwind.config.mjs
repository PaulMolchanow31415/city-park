/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        fontFamily: {
            sans: ['Roboto', 'sans-serif'],
            serif: ['Merriweather', 'serif'],
        },
        container: {
            center: true,
            padding: '.75rem',
            screens: {
                'sm': '740px',
                'md': '940px',
                'lg': '1084px',
                'xl': '1200px',
                '2xl': '1440px',
            },
        },
        extend: {
            colors: {
                'dark': '#171700',
                'maroon': '#3c1c11',
                'brown': '#887863',
                'lime': '#edf964',
                'border': 'rgba(0, 0, 0, 0.15)',
                'shadow': 'rgba(0, 0, 0, 0.55)',
            },
        },
    },

    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
