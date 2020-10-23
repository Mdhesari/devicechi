const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js");

// additonal custom resources
mix.postCss("resources/css/normalize.css", "public/css/normalize.min.css");

// scss
mix.sass("resources/scss/front-style.scss", "public/css/front-style.min.css")
    .sass(
        "resources/scss/bootstrap-vue.scss",
        "public/css/bootstrap-vue.min.css"
    )
    .sass(
        "resources/scss/bootstrap-rtl.scss",
        "public/css/bootstrap-rtl.min.css"
    );
