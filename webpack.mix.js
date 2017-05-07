const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/website/js/botomera.js')
    .sass('resources/assets/sass/app.scss', 'public/website/css', {
       precision:5
    })
    .styles([
        'public/website/css/animate.min.css',
        'public/website/css/ma_helper.css',
    ],'public/website/css/helper.css');


mix.browserSync({
    proxy: 'http://127.0.0.1:8000/'
});


