const dotenvExpand = require("dotenv-expand");
dotenvExpand(
    require("dotenv").config({ path: "../../.env" /*, debug: true*/ })
);

const mix = require("laravel-mix");
require("laravel-mix-merge-manifest");

mix.setPublicPath("../../public").mergeManifest();

mix.js(__dirname + "/Resources/assets/js/app.js", "js/team/team.js")
    .sass(__dirname + "/Resources/assets/sass/app.scss", "css/team/team.css")
    .postCss(__dirname + "/Resources/assets/css/tailwind.css", "css/team/tailwind.css", [
        require("postcss-import"),
        require("tailwindcss")
    ]);

if (mix.inProduction()) {
    mix.version();
}
