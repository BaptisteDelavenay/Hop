/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{html,php,js}",
    "./ASSETS/**/*.{html,php,js}",
    "./compte/**/*.{html,php,js}",
    "./**/*.{html,php,js}",
    "!./node_modules/**",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
