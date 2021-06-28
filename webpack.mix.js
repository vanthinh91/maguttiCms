const mix = require('laravel-mix');
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
//if (mix.inProduction()) {
	mix.sass('resources/sass/admin/vendor.scss', 'public/cms/css/')
		.js('resources/js/admin/cmsvendor.js', 'public/cms/js/cmsvendor.js')
		.version();

	/*
	|--------------------------------------------------------------------------
	| Admin
	|--------------------------------------------------------------------------
	*/

	mix.sass('resources/sass/admin/app.scss', 'public/cms/css/')
		.js('resources/js/admin/cms.js', 'public/cms/js/cms.js')
		.js('resources/js/admin/header.js', 'public/cms/js/header.js')
		.js('resources/js/admin/lara-file-manager.js', 'public/cms/js')
		.js('resources/js/admin/appcms.js', 'public/cms/js/').vue();

//} else {
	mix.options({
		processCssUrls: true,

	});
//}

/*
 |--------------------------------------------------------------------------
 | Website
 |--------------------------------------------------------------------------
*/

mix.sass('resources/sass/website/vendor.scss', 'public/website/css')
	.js('resources/js/website/vendor.js', 'public/website/js')

mix.sass('resources/sass/website/app.scss', 'public/website/css')
	.js('resources/js/website/app.js', 'public/website/js')
	.js('resources/js/website/cart.js', 'public/website/js').vue();

mix.mergeManifest();
