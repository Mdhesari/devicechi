<template>
    <section class="user-panel-section">
        <div class="container">
            <b-nav tabs class="mb-4">
                <b-nav-item
                    v-for="(nav, index) in nav_items"
                    :key="index"
                    :active="nav.is_active"
                >
                    <inertia-Link
                        :href="nav.route"
                        v-text="nav.label"
                    ></inertia-Link>
                </b-nav-item>
            </b-nav>

            <div class="row user-panel-main">
                <div class="col-md-4">
                    <div class="sidebar">
                        <inertia-link
                            :href="route('user.ad.create')"
                            class="btn btn-success btn-rounded-high btn-mobilesale"
                        >
                            {{ __("ads.create.btn_title") }}
                        </inertia-link>

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
