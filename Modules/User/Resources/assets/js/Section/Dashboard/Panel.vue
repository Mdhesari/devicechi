<template>
    <section class="user-panel-section">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <inertia-link
                        :href="route('user.ad.create')"
                        class="btn btn-success btn-rounded-high btn-mobilesale"
                    >
                        {{ __("ads.create.btn_title") }}
                    </inertia-link>
                </div>
            </div>
            <b-nav tabs class="mb-4">
                <li
                    class="nav-item"
                    v-for="(nav, index) in nav_items"
                    :key="index"
                >
                    <inertia-Link
                        class="nav-link"
                        :class="{ active: nav.is_active }"
                        :href="nav.route"
                        v-text="nav.label"
                    ></inertia-Link>
                </li>
            </b-nav>

            <div class="row user-panel-main">
                <div class="col-md-4">
                    <div class="sidebar">
                        <ProfileTabs :user="user" :tabs="tabs"></ProfileTabs>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="content">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import spinner from "../../Components/Spinner";
import ProfileTabs from "../../Components/ProfileTabs";

export default {
    components: {
        spinner,
        ProfileTabs
    },
    props: ["user", "tabs"],
    data() {
        return {
            form: this.$inertia.form({}),
            nav_items: this.getProp("nav_items")
        };
    },
    methods: {}
};
</script>
