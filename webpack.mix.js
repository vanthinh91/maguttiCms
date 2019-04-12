const  mix = require('laravel-mix');

require('laravel-mix-merge-manifest');

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

if (mix.config.production || mix.config.development) {
	mix.sass('resources/assets/sass/vendor.scss', 'public/website/css/');

	mix.js('resources/assets/js/vendor.js', 'public/website/js');
	mix.version();
} else {
	mix.config.processCssUrls = false;
}

mix.sass('resources/assets/sass/admin.scss' , 'public/cms/css/');
mix.js('resources/assets/js/header.js',            'public/cms/js/header.js');
mix.js('resources/assets/js/cms.js',               'public/cms/js/cms.js');
mix.js('resources/assets/js/appcms.js', 'public/cms/js/appcms.js');

mix.sass('resources/assets/sass/app.scss'   , 'public/website/css/');
mix.js('resources/assets/js/app.js',               'public/website/js');
mix.js('resources/assets/js/store.js',             'public/website/js');
mix.js('resources/assets/js/lara-file-manager.js', 'public/cms/js');

mix.mergeManifest();
