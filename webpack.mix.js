const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.browserSync('laravel.blog');

// admin
mix.styles([
   'resources/assets/admin/plugins/fontawesome-free/css/all.min.css',
   'resources/assets/admin/css/adminlte.min.css',
    'resources/assets/admin/plugins/select2/css/select2.css',
], 'public/assets/admin/css/admin.css');

mix.scripts([
   'resources/assets/admin/plugins/jquery/jquery.min.js',
    'resources/assets/admin/plugins/bootstrap/bootstrap.bundle.min.js',
    'resources/assets/admin/plugins/select2/js/select2.full.js',
    'resources/assets/admin/js/adminlte.min.js',
    'resources/assets/admin/js/demo.js',
], 'public/assets/admin/js/admin.js');

mix.copyDirectory('resources/assets/admin/img', 'public/assets/admin/img');
mix.copyDirectory('resources/assets/admin/plugins/fontawesome-free/webfonts', 'public/assets/admin/webfonts');
mix.copy('resources/assets/admin/css/adminlte.min.css.map', 'public/assets/admin/css/adminlte.min.css.map');

// POST

mix.styles([
    'resources/assets/base/css/linearicons.css',
    'resources/assets/base/css/font-awesome.min.css',
    'resources/assets/base/css/fontawesome.css',
    'resources/assets/base/css/magnific-popup.css',
    'resources/assets/base/css/nice-select.css',
    'resources/assets/base/css/owl.carousel.css',
    'resources/assets/base/css/bootstrap.css',
    'resources/assets/base/css/bootstrap-datepicker.css',
    'resources/assets/base/css/themify-icons.css',
    'resources/assets/base/css/main.css',
    'resources/css/app.css',
], 'public/assets/base/css/styles.css');

mix.scripts([
    'resources/assets/base/js/vendor/jquery-2.2.4.min.js',
    'resources/assets/base/js/vendor/bootstrap.min.js',
    'resources/assets/base/js/owl.carousel.min.js',
    'resources/assets/base/js/jquery.sticky.min.js',
    'resources/assets/base/js/jquery.tabs.min.js',
    'resources/assets/base/js/parallax.min.js',
    'resources/assets/base/js/jquery.nice-select.min.js',
    'resources/assets/base/js/jquery.ajaxchimp.min.js',
    'resources/assets/base/js/jquery.magnific-popup.min.js',
    'resources/assets/base/js/bootstrap-datepicker.js',
    'resources/assets/base/js/main.js',
    'resources/js/custom.js',
], 'public/assets/base/js/app.js');
mix.copyDirectory('resources/assets/base/fonts', 'public/assets/base/fonts');
// mix.styles([
//     ''
// ])

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');
