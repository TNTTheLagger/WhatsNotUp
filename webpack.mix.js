const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .css('resources/sass/app.css', 'public/css')
   .version();
