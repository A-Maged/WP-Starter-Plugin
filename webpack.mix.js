const mix = require('laravel-mix');

require('dotenv').config();
require('mix-tailwindcss');
require('laravel-mix-purgecss');

mix.js('js/index.js', 'build')
    .sass('style/style.scss', 'build')
    // .sass('style/admin.scss', 'build')
    .tailwind()
    .purgeCss({
        enabled: true,
        content: ['**/*.php'],
    })
    .sourceMaps(!mix.inProduction(), 'source-map')
    .browserSync({
        proxy: process.env.URL,
        files: ['./**/*.php', './**/*.js', './**/*.scss'],
        ignore: ['./.git', './**/node_modules', './build', './vendor'],
    })

    .disableSuccessNotifications();
