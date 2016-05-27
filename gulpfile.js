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
	// mix.sass('app.scss');
	mix.less('spark.less');
	// mix.styles(['bootstrap-social.css']);

	mix.styles([
	    // 'app.css',
	    'spark.css',
	    // all.css has all css coming from mix.styles() combined
	    'all.css',
	], 'public/css/booknshelf.css', 'public/css');

	// scripts
	mix.browserify('app.js');
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
