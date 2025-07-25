/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // "./*.html",
    // "./*.php",
    // "./src/**/*.{html,js,php}"
         './vendor/filament/**/*.blade.php',
        './resources/views/**/*.blade.php',
        './resources/css/**/*.css',
  ],
  theme: {
          extend: {
            colors: {
                customSidebar: '#1a2b3c',
            },
        },
  },
  plugins: [],
}