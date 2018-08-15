var elixir = require('laravel-elixir');

// elixir(function(mix) {
//     mix.scripts('resources/assets/js/app.js', 'public/js')
// });


/**
* TODO: add loop to parse directories
*/

//default theme 
elixir(function(mix) {
	mix.scripts('resources/assets/js/theme-default/app.js', 'public/js/theme-default')
    .sass('resources/assets/sass/theme-default/index.scss', 'public/css/theme-default');
});

//theme 1
elixir(function(mix) {
	mix.scripts('resources/assets/js/theme-1/app.js', 'public/js/theme-1')
    mix.sass('resources/assets/sass/theme-1/index.scss', 'public/css/theme-1');
});

elixir(function(mix) {
    mix.copy('resources/assets/images', 'public/images', false);
});    
