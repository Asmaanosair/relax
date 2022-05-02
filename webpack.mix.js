const mix = require('laravel-mix')
const WebpackRTLPlugin = require('webpack-rtl-plugin')

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

mix.webpackConfig({
  output: {
    chunkFilename: 'js/[name].js'
  },
  plugins: [new WebpackRTLPlugin()]
})

mix.sass('resources/sass/vendors.scss', 'public/css')

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
