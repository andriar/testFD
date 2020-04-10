const mix = require('laravel-mix');
require('dotenv').config();

mix.webpackConfig({
	resolve: {
		extensions: [ '.js', '.vue' ],
		alias: {
			'@': __dirname + '/resources',
		},
	},
});

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

mix.ts('resources/js/main.ts', 'public/js').sass('resources/sass/app.scss', 'public/css').sourceMaps();
