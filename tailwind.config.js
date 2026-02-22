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
    extend: {
      // colors: {
      //   hopViolet: "#6030E1",
      //   hopNoir: "#212121",
      //   hopNeon: "#E5FF30",
      //   hopVert: "#A3D400",
      // },
    },
  },
  plugins: [],
};
