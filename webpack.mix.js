const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/main.scss', 'public/css/main.css')
    .sass('resources/sass/login/style.scss', 'public/css/login/style.css')
    .sass('resources/sass/show_profile/style.scss', 'public/css/show_profile/style.css')
    .sass('resources/sass/soa/style.scss', 'public/css/soa/style.css')
    .sass('resources/sass/template/style.scss', 'public/css/template/style.css');
