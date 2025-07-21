module.exports = {
  content: [
    './resources/**/*.{blade.php,js,vue}', // Blade & JS files
    './app/**/*.php',                      // PHP logic files (optional but useful)
    './resources/views/**/*.blade.php',    // Blade views
  ],
  theme: {
    extend: {
      colors: {
        'bg-cream': '#F2EFE8',
        'text-black-theme': '#272727',
        'theme-grey': '#FAFAF8',
      },
    },
  },
  plugins: [],
}
