require("./bootstrap");

import Vue from "vue";
import Lang from "lang.js";

import { InertiaApp } from "@inertiajs/inertia-vue";
import { InertiaForm } from "laravel-jetstream";
import PortalVue from "portal-vue";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import { InertiaProgress } from "@inertiajs/progress";

const default_locale = window.default_locale;
const fallback_locale = window.fallback_locale;
const messages = window.messages;
Vue.prototype.$t = new Lang({
    messages: messages,
    locale: default_locale,
    fallback: fallback_locale
});

InertiaProgress.init({
    color: "#fcc55a",
    showSpinner: true
});

Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

Vue.mixin({
    methods: {
        route,
        tr: (key, rep, locale) =>
            new Lang({
                messages,
                locale: default_locale,
                fallback: fallback_locale
            }).get(key, rep, locale)
    }
});

const app = document.getElementById("app");

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(app);
