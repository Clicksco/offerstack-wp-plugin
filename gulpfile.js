var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.scripts('resources/assets/js/app.js', 'public/js')
});


/**
* TODO: add loop to parse directories
*/

//default theme 
elixir(function(mix) {
    mix.sass('resources/assets/sass/theme-default/index.scss', 'public/css/theme-default');
});

//theme 1
elixir(function(mix) {
    mix.sass('resources/assets/sass/theme-1/index.scss', 'public/css/theme-1');
});

elixir(function(mix) {
    mix.copy('resources/assets/images', 'public/images', false);
});    
