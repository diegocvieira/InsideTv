let mix = require('laravel-mix');

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

 //mix.sass('resources/assets/sass/header.scss', 'public/css')
    //.sass('resources/assets/sass/index.scss', 'public/css');

 mix.copyDirectory('resources/assets/images', 'public/images');

//mix.styles([
    //'public/css/header.css',
    //'public/css/global.css'
//], 'public/css/global.css');
mix.sass('resources/assets/sass/global.scss', 'public/css');

mix.js('resources/assets/js/global.js', 'public/js')
