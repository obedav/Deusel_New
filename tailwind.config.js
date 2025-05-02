/** @type {import('tailwindcss').Config} */
// tailwind.config.js
module.exports = {
  content: [
    "./path/to/your/html/**/*.html", // Specify the path to your HTML files
  ],
  theme: {
    extend: {
      borderRadius: {
        '5': '5px', // Custom border-radius of 5px
      },
      colors: {
        'primary': '#1D4ED8', // Custom primary color
        'secondary': '#F59E0B', // Custom secondary color
      },
      spacing: {
        '72': '18rem', // Custom spacing value (for margin, padding, etc.)
      },
    },
  },
  plugins: [],
}


