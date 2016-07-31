var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	// stylings
	mix.styles([
		'sweetalert.css',
		'bootstrap-social.css',
		// 'hover.css',
		// 'animate.css',
		// 'magnific-popup.css',
		// 'salvattore.css',
	], 'public/css/helpers.css');

	mix.less('app.less');

	mix.styles([
		// all.css has all css coming from mix.styles() combined
		'helpers.css',
		// app.css has all .less files merged into one single file
	    'app.css',
	], 'public/css/booknshelf.css', 'public/css');

	// scripts
	mix.browserify('app.js');
	mix.scripts([
	    'vendor/sweetalert-dev.js',
        'vendor/toolkit.js',
	    'vendor/bootstrap',

	    // 'vendor/hydrogen/jquery.easing.1.3.js',
	    // 'vendor/hydrogen/jquery.waypoints.min.js',
	    // 'vendor/hydrogen/salvattore.min.js',
	    // 'vendor/hydrogen/main.js',
	], 'public/js/booknshelf.js');

	mix.version(['public/css/booknshelf.css','public/js/booknshelf.js']);
	// copy the fonts to public/build/ directory
	mix.copy('resources/assets/fonts', 'public/build/fonts');
	// copy the img to public/ directory
	mix.copy('resources/assets/img', 'public/img');

});
