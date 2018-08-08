var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.scripts('resources/assets/js/app.js', 'public/js')
    .sass([
        'offers-page-style.scss',
        'style.scss'
    ])
    .copy('resources/assets/images', 'public/images', false);
});