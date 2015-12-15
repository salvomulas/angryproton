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

var paths = {
    'bootstrap': './node_modules/bootstrap-sass/assets/',
    'fa': './node_modules/font-awesome/'
}

elixir(function (mix) {
    mix.sass([
            'app.scss',
        ],
        'public/css/style.css');
    mix.scripts(paths.bootstrap + "javascripts/bootstrap.js", 'public/js/bootstrap.js');
    mix.copy(paths.fa + "fonts/", "public/fonts");
    mix.copy(paths.fa + "css/font-awesome.css", "public/css/font-awesome.css");
    mix.copy(paths.bootstrap + "fonts/", 'public/fonts/');
    mix.browserSync({
        proxy: 'angryproton.dev'
    });
});