<template>
    <!-- Footer Content -->
    <footer class="footer-site">
        <div class="container">
            <div class="row mb-2">
                <div class="col-12 col-md-1">
                    <div class="social">
                        <a
                            href="https://instagram.com/mobile.for.sales"
                            target="_blank"
                            class="instagram"
                        >
                            <b-icon icon="instagram"></b-icon>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="menu text-center">
                        <ul>
                            <li v-for="(nav, item) in navbar" :key="item">
                                <a :href="nav.route">
                                    {{ nav.title }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="copy-right rtl">
                        کلیه حقوق مادی و معنوی این وبسایت محفوظ می باشد
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            navbar: this.getProp("footer_navbar"),
            user: this.getProp("user")
        };
    }
};
</script>
