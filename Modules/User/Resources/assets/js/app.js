require("./bootstrap");

import Vue from "vue";
import Lang from "lang.js";
import VueToastr from "vue-toastr";

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
Vue.use(VueToastr);

Vue.mixin({
    methods: {
        route,
        $to(
            title,
            message = "",
            type = "e" /* s: success, e: error, w:warning, i: information */
        ) {
            if (!title) return this.$toastr;

            return this.$toastr[type](title, message);
        },
        url(path) {
            return this.$inertia.page.props.current_root + "/" + path;
        },
        getProp(param) {
            return this.$inertia.page.props[param];
        },
        __(name, replace) {
            return this.$t.get(name, replace);
        },
        formatMoney(amount, decimalCount = 0, decimal = ".", thousands = ",") {
            try {
                decimalCount = Math.abs(decimalCount);
                decimalCount = isNaN(decimalCount) ? 0 : decimalCount;

                const negativeSign = amount < 0 ? "-" : "";

                let i = parseInt(
                    (amount = Math.abs(Number(amount) || 0).toFixed(
                        decimalCount
                    ))
                ).toString();
                let j = i.length > 3 ? i.length % 3 : 0;

                return (
                    negativeSign +
                    (j ? i.substr(0, j) + thousands : "") +
                    i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) +
                    (decimalCount
                        ? decimal +
                          Math.abs(amount - i)
                              .toFixed(decimalCount)
                              .slice(2)
                        : "")
                );
            } catch (e) {
                this.$to(
                    __("global.errors.common.title"),
                    __("global.errors.common.desc")
                );
                console.log(e);
            }
        }
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
