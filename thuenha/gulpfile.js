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
    mix.sass(['app.scss', 'home.scss', 'house.scss'], 'public/assets/css');
    mix.sass('profile.scss','public/assets/css/profile.css');
    mix.sass('unapprovedhouses.scss','public/assets/css/unapprovedhouses.css');
    mix.scripts(['search.js','footer.js', 'app.js'], 'public/assets/js');
    mix.scripts('house.js', 'public/assets/js/house.js');
    mix.scripts('index.js', 'public/assets/js/index.js');
    mix.scripts('profile.js', 'public/assets/js/profile.js');
    mix.scripts('approve.js', 'public/assets/js/approve.js');
});
