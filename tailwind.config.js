/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'sky-blue': '#82c8e5',
                'dark-navy': '#0a192f',
                'glass-white': 'rgba(255, 255, 255, 0.1)',
            },
            boxShadow: {
                'glow': '0 0 15px rgba(130, 200, 229, 0.3), 0 0 5px rgba(130, 200, 229, 0.2)',
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            }
        },
    },
    plugins: [],
};
