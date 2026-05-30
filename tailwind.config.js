/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['Inter', 'system-ui', 'Segoe UI', 'sans-serif'],
            },
            colors: {
                primary: {
                    DEFAULT: '#3b82f6',
                    dark: '#2563eb',
                }
            }
        },
    },
    plugins: [],
}