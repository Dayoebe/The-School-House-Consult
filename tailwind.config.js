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
        cream: '#fffaf2',
        teal: '#0f766e',
        coral: '#ef6f61',
      },
      fontFamily: {
        sans: ['Plus Jakarta Sans', 'sans-serif'],
        display: ['Bricolage Grotesque', 'sans-serif'],
      },
    },
  },
  plugins: [],
};

