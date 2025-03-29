const mix = require('laravel-mix');

mix
   .scripts('node_modules/jquery/dist/jquery.js', 'public/assets/js/jquery.js')
   .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/assets/js/bootstrap.js')
   .sass('resources/sass/app.scss', 'public/assets/css/app.css')
   .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/assets/webfonts') 
   .sourceMaps()

   //Versionamento
   .version();
