var elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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
	], 'public/css/helpers.css');

	mix.less('app.less');

	mix.styles([
		// all.css has all css coming from mix.styles() combined
		'helpers.css',
		// app.css has all .less files merged into one single file
	    'app.css',
	], 'public/css/booknshelf.css', 'public/css');

	// scripts
    // var c = require('./webpack.config.js');
	mix.webpack('app.js');
	mix.scripts([
	    'vendor/sweetalert-dev.js',
        // 'vendor/toolkit.js',
	    // 'vendor/bootstrap',
	], 'public/js/booknshelf.js');

	mix.version(['public/css/booknshelf.css','public/js/booknshelf.js']);
	// copy the fonts to public/build/ directory
	mix.copy('resources/assets/fonts', 'public/build/fonts');
	// copy the img to public/ directory
	mix.copy('resources/assets/img', 'public/img');

});
