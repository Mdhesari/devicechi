const dotenvExpand = require("dotenv-expand");
dotenvExpand(
    require("dotenv").config({ path: "../../.env" /*, debug: true*/ })
);

const mix = require("laravel-mix");
require("laravel-mix-merge-manifest");

mix.disableSuccessNotifications();

mix.setPublicPath("../../public").mergeManifest();

// mix.browserSync('localhost');

mix.js(__dirname + "/Resources/assets/js/app.js", "js/user/user.js")
    .js(__dirname + "/Resources/assets/js/libs/moment.js", "js/user/moment.js")
    .sass(
        __dirname + "/Resources/assets/sass/front-style.scss",
        "css/user/user.css"
    )
    .sass(
        __dirname + "/Resources/assets/sass/bootstrap-vue.scss",
        "css/user/bootstrap-vue.css"
    )
    .sass(
        __dirname + "/Resources/assets/sass/swiper.scss",
        "css/user/swiper.css"
    )
    .postCss(
        __dirname + "/Resources/assets/css/normalize.css",
        "css/user/normalize.css"
    );

if (mix.inProduction()) {
    mix.version();
}
