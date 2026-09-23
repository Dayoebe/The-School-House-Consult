/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        navy: '#0b2a5b',
        orange: '#f47b20',
        ink: '#172033',
        muted: '#5b6575',
        soft: '#f5f7fa',
        line: '#dfe4ec',
      },
      fontFamily: {
        sans: ['Arial', 'Helvetica Neue', 'sans-serif'],
      },
    },
  },
  plugins: [],
};

