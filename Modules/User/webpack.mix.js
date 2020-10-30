const dotenvExpand = require("dotenv-expand");
dotenvExpand(
    require("dotenv").config({ path: "../../.env" /*, debug: true*/ })
);

const mix = require("laravel-mix");
require("laravel-mix-merge-manifest");

mix.setPublicPath("../../public").mergeManifest();

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
        __dirname + "/Resources/assets/sass/bootstrap-rtl.scss",
        "css/user/bootstrap-rtl.css"
    )
    .postCss(
        __dirname + "/Resources/assets/css/normalize.css",
        "css/user/normalize.css"
    );

if (mix.inProduction()) {
    mix.version();
}
