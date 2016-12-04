var elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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
	// mix.styles([
	// 	'sweetalert.css',
	// // 	'hover-min.css'
	// ], 'public/css/helpers.css');

	// mix.sass('app.scss');
	mix.less('app.less');
	// mix.sass('material-kit.scss');
	mix.styles([
		// app.css has all .less files merged into one single file
        'app.css',
        // 'helpers.css',
	], 'public/css/booknshelf.css', 'public/css');

	// scripts
    mix.webpack('app.js');


	mix.version([
	    'public/css/booknshelf.css',
        'public/js/app.js'
    ]);
	// copy the fonts to public/build/ directory
	mix.copy('resources/assets/fonts', 'public/build/fonts');
	// copy the img to public/ directory
	mix.copy('resources/assets/img', 'public/img');

});
