const { mix } = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Fo development Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/assets/sass/vendor.scss','public/website/css/');
mix.sass('resources/assets/sass/app.scss', 	 'public/website/css/');
mix.sass('resources/assets/sass/admin.scss', 'public/cms/css/');
mix.sass('resources/assets/sass/admin/vendor.scss', 'public/cms/css/');

mix.js('resources/assets/js/vendor.js',            'public/website/js');
mix.js('resources/assets/js/app.js',               'public/website/js');
mix.js('resources/assets/js/store.js',             'public/website/js');
mix.js('resources/assets/js/cmsvendor.js',         'public/cms/js/cmsvendor.js');
mix.js('resources/assets/js/cms.js',               'public/cms/js/cms.js');
mix.js('resources/assets/js/header.js',            'public/cms/js/header.js');
mix.js('resources/assets/js/lara-file-manager.js', 'public/cms/js');

if (mix.config.inProduction) {
    mix.version();
}
mix.browserSync({
    host: 'localhost',
    port: 8000,
    proxy: 'http://127.0.0.1:8000/'
});
