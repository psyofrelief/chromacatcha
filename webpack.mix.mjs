const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.js('resources/js/app.js', 'public/js')
.css('resources/css/app.css', 'public/css', [
      tailwindcss('tailwind.config.js'),
])
   .postCss('resources/css/app.css', 'public/css', [
      tailwindcss('tailwind.config.js'),
   ]);
