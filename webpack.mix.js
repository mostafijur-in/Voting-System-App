const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

// Custom styles
mix.styles('resources/css/custom-styles.css', 'public/css/custom-styles.css');

// Custom scripts
mix.js('resources/js/custom-scripts.js', 'public/js/custom-scripts.js');

// Copy images
mix.copyDirectory('resources/img', 'public/images');
