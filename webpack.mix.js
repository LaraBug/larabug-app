const mix = require('laravel-mix')
const path = require('path')
const tailwindcss = require('tailwindcss')

mix
    .sass('resources/assets/sass/frontend/app.scss', 'public/css/frontend.css', {},
        [tailwindcss('tailwind.config.js')]
    )
    .sass('resources/assets/sass/panel/app.scss', 'public/css/app.css', {},
        [tailwindcss('tailwind.panel.js')]
    )
    .sass('resources/assets/sass/admin/app.scss', 'public/css/admin.css', {},
        [tailwindcss('tailwind.admin.js')]
    )

    .options({
        processCssUrls: false,
    })

    .js('resources/assets/js/panel/app.js', 'public/js').vue({version: 3})
    .js('resources/assets/js/frontend/frontend.js', 'public/js')

    .webpackConfig({
        output: {chunkFilename: 'js/[name].js?id=[chunkhash]'},
        resolve: {
            alias: {
                '@': path.resolve('resources/assets/js/panel'),
            },
        },
    })
    .babelConfig({
        plugins: ['@babel/plugin-syntax-dynamic-import'],
    })
    .disableSuccessNotifications();

if (mix.inProduction()) {
    mix.version();
}
