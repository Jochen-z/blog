let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/admin.js', 'public/js');

// 将 svg 打包成 svg-sprite
// const SpriteLoaderPlugin = require('svg-sprite-loader/plugin');
// mix.webpackConfig({
//     plugins: [
//         new SpriteLoaderPlugin({
//             test: /\.svg$/,
//             loader: 'svg-sprite-loader',
//             include: ['resources/assets/js/icons'],
//             options: {
//                 symbolId: 'icon-[name]',
//                 publicPath: 'resources/assets/js/icons'
//             }
//         })
//     ]
// });

// mix.webpackConfig({
//     module: {
//         rules: [
//             {
//                 test: /\.svg$/,
//                 loader: 'svg-sprite-loader',
//                 include: ['resources/assets/js/icons'],
//                 options: {
//                     symbolId: 'icon-[name]'
//                 }
//             },
//             {
//                 test: /\.(woff2?|ttf|eot|svg|otf)$/,
//                 loader: 'file-loader',
//                 exclude: ['resources/assets/js/icons'],
//                 options: {
//                     name: path => {
//                         if (! /node_modules|bower_components/.test(path)) {
//                             return Config.fileLoaderDirs.fonts + '/[name].[ext]?[hash]';
//                         }
//
//                         return Config.fileLoaderDirs.fonts + '/vendor/' + path
//                             .replace(/\\/g, '/')
//                             .replace(
//                                 /((.*(node_modules|bower_components))|fonts|font|assets)\//g, ''
//                             ) + '?[hash]';
//                     },
//                     publicPath: Config.resourceRoot
//                 }
//             }
//         ]
//     }
// });