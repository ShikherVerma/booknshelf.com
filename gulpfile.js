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
	mix.sass('vendor/sweetalert.scss');
	mix.less('app.less');
	mix.styles(['bootstrap-social.css']);

	mix.styles([
	    'sweetalert.css',
	    'app.css',
	    'all.css',
	], 'public/css/booknshelf.css', 'public/css');

	mix.browserify('app.js');

	// scripts
	mix.scripts([
	    'vendor/sweetalert-dev.js',
	    'vendor/typeahead.js',
	    'helpers.js',
	], 'public/js/booknshelf.js');

	mix.version(['public/css/booknshelf.css','public/js/booknshelf.js']);
	// copy the fonts to public/build/ directory
	mix.copy('resources/assets/fonts', 'public/build/fonts');
	// copy the img to public/ directory
	mix.copy('resources/assets/img', 'public/img');

	// mix.browserSync({
	//     proxy: 'homestead.app'
	// });

});
