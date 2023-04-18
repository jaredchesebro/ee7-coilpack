const mix = require('laravel-mix');

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

mix.setPublicPath('public')
  .options({
      processCssUrls: false,
  })
  .sourceMaps(false, 'source-map')
  .js('resources/js/main.js', 'public/assets/js')
  .sass('resources/scss/main.scss', 'public/assets/css')
  .version();
  //.copy('resources/fonts', 'public/assets/fonts');
  //.copy('resources/images', 'public/assets/images');
