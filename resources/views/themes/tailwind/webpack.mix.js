const mix = require('laravel-mix');
const glob = require('glob-all');

require('laravel-mix-tailwind');
require('laravel-mix-purgecss');
const tailwindcss = require('tailwindcss'); // Importer tailwindcss

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

mix.setPublicPath('../../../../public/themes/tailwind/')
	.sass('assets/sass/app.scss', 'css')
	.js('assets/js/app.js', 'js')
	.js('assets/js/inbox.js', 'js')
	.vue()
	.tailwind('./tailwind.config.js');


// mix.setPublicPath('public/themes/tailwind')
// 	.sass('resources/views/themes/tailwind/assets/sass/app.scss', 'css')
// 	.js('resources/views/themes/tailwind/assets/js/app.js', 'js')
// 	.vue()
// 	.options({
// 		 processCssUrls: false,
// 		 postCss: [tailwindcss('./tailwind.config.js')],
// 	 });
 
//  if (mix.inProduction()) {
// 	 mix.version();
//  }
 