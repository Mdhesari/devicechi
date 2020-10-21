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

mix.js("resources/js/app.js", "public/js").postCss(
    "resources/css/tailwind.css",
    "public/css",
    [require("postcss-import"), require("tailwindcss")]
);

// additonal custom resources
mix.postCss("resources/css/normalize.css", "public/css/normalize.min.css")
    .postCss("resources/css/bootstrap.css", "public/css/bootstrap.min.css")
    .postCss(
        "resources/css/bootstrap-rtl.css",
        "public/css/bootstrap-rtl.min.css"
    );

// scss
mix.sass(
    "resources/scss/front-style.scss",
    "public/css/front-style.min.css"
);
