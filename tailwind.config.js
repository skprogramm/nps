/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php",
    "./**/*.html",
    "./**/*.js",
    "./pages/**/*.php",
    "./pages/**/*.css",
    "./admin/**/*.php",
    "./components/**/*.php"
  ],

  theme: {
    extend: {
      colors: {
        'nps-red': '#d62828',
        'nps-green': '#2c5aa0',
      }
    },
  },
  plugins: [],
}