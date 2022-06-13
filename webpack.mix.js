const mix = require('laravel-mix');
mix.browserSync({
    proxy: 'http://127.0.0.1:8000'
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 /*
mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
*/

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/add.scss', 'public/css')
    .sass('resources/scss/editProfile.scss', 'public/css')
    .sass('resources/scss/home.scss', 'public/css')
    .sass('resources/scss/login.scss', 'public/css')
    .sass('resources/scss/pet.scss', 'public/css')
    .sass('resources/scss/profile.scss', 'public/css')
    .sass('resources/scss/register.scss', 'public/css')
    .sass('resources/scss/styles.scss', 'public/css');
