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

 mix.copyDirectory('resources/assets/images', 'public/images');

mix.sass('resources/assets/sass/global.scss', 'public/css');

mix.js('resources/assets/js/global.js', 'public/js')
    .js('resources/assets/js/show-serie', 'public/js')
    .js('resources/assets/js/listas', 'public/js')
    .js('resources/assets/js/Insidetv', 'public/js')
    .js('resources/assets/js/ListaController', 'public/js');
