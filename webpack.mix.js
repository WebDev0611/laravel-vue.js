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



   // Main
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .options({
         processCssUrls: false,
         postCss: [
            require('autoprefixer')({
               browsers: [
                  'safari > 7',
                  'iOS > 6'
               ],
               cascade: false
            })
         ]
   })

   // Individual Page Files
   .js('resources/assets/js/components/welcome-modal.js', 'public/js/components')
   .js('resources/assets/js/components/settings-modal.js', 'public/js/components')
   .js('resources/assets/js/components/country-select.js', 'public/js/components')
   .js('resources/assets/js/components/verify.js', 'public/js/components')

   // 360 Tour Upload & Viewer
   .js('resources/assets/js/360Tool.js', 'public/js/360Tool.js')
   .js('resources/assets/js/360Viewer.js', 'public/js/360Viewer.js')
   .sass('resources/assets/sass/360/360.scss', 'public/css/360.css')

