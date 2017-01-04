const elixir = require('laravel-elixir');

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

elixir(mix => {
    //mix.sass('app.scss')
    //   .webpack('app.js');
    mix.copy(
        'node_modules/font-awesome/fonts',
        'public/fonts/font-awesome'
    )
    .copy(
        'node_modules/bootstrap-sass/assets/fonts/bootstrap',
        'public/fonts/bootstrap'
    )

    .sass([
        'frontend/app.scss',
        'plugins/share/share.scss'
    ],'resources/assets/css/frontend/app.css')

    .styles([
        'frontend/app.css'
    ], 'public/css/frontend.css')

    .webpack([
        'frontend/app.js'
    ],'resources/assets/js/frontend.js')

    .scripts([
        'frontend.js',
        'plugins/share/jquery.share.js'
    ], 'public/js/frontend.js')

    .sass([
        'backend/app.scss',
        'plugins/sweetalert/sweetalert.scss'
    ], 'resources/assets/css/backend/app.css')

    .styles([
        'backend/app.css'
    ], 'public/css/backend.css')

    .webpack('backend/app.js', './resources/assets/js/backend.js')

    .scripts([
        'backend.js',
        'script.js',
        'plugins/InlineAttachment/codemirror-4.inline-attachment.min.js',
        'plugins/sweetalert/sweetalert.min.js',
    ], 'public/js/backend.js')

});
