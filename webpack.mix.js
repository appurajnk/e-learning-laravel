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

mix.setPublicPath('public')
    //.setResourceRoot('../') // turns assets paths in css relative to css file
    .sass('resources/sass/frontend/app.scss', 'css/frontend.css')
    .sass('resources/sass/backend/app.scss', 'css/backend.css')
    // .sass('resources/sass/frontend/themes/red.scss', 'css/red.css')
    // .sass('resources/sass/frontend/themes/teal.scss', 'css/teal.css')
    // .sass('resources/sass/frontend/themes/green.scss', 'css/green.css')
    .js('resources/js/frontend/app.js', 'js/frontend.js')
    .js('resources/js/backend/app.js', 'js/backend.js')
    .sourceMaps();
    // .js([
    //     'resources/js/backend/before.js',
    //     'resources/js/backend/app.js',
    //     'resources/js/backend/after.js'
    // ], 'js/backend.js')
    // .extract([
    //     'jquery',
    //     'bootstrap',
    //     'popper.js',
    //     'axios',
    //     'sweetalert2',
    //     'lodash'
    // ])
    // .sourceMaps();

if (mix.inProduction()) {
    mix.version()
        .options({
            // optimize js minification process
            terser: {
                cache: true,
                parallel: true,
                sourceMap: true
            }
        });
} else {
    // Uses inline source-maps on development
    mix.webpackConfig({ devtool: 'inline-source-map' });
}

mix.options({
    processCssUrls: true
});