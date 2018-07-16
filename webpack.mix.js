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


mix.webpackConfig({
    // Vue.js Async Component Chunks
    output: {
        publicPath: '/',
        chunkFilename: 'js/chunks/[name].[chunkhash].js',
    },
});


Mix.listen('configReady', (webpackConfig) => {
    // Create SVG sprites
    webpackConfig.module.rules.unshift({
        test: /\.svg$/,
        loader: 'svg-sprite-loader',
        include: /(assets\/js\/icons\/svg)/,
        options: {
            symbolId: 'icon-[name]',
        }
    });

    // Exclude 'svg' folder from font loader
    let fontLoaderConfig = webpackConfig.module.rules.find(rule => String(rule.test) === String(/\.(woff2?|ttf|eot|svg|otf)$/));
    fontLoaderConfig.exclude = /(assets\/js\/icons\/svg)/;
});