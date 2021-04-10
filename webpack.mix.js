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

    .js('resources/assets/js/panel/app.js', 'public/js')
    .js('resources/assets/js/frontend/frontend.js', 'public/js')

    .options({
        processCssUrls: false,
        autoprefixer: false
    })
    .vue()
    .alias({
        '@': path.join(__dirname, 'resources/assets/js/panel'),
    })

if (mix.inProduction()) {
    mix.version();
}