<template>
    <section class="user-panel-section">
        <div class="container-lg">
            <div class="row mx-2">
                <inertia-link
                    preserve-scroll
                    :href="route('user.ad.create')"
                    class="btn btn-success btn-rounded-high btn-mobilesale"
                >
                    <b-icon icon="plus-circle"></b-icon>
                    <span class="btn-title">{{
                        __("ads.create.btn_title")
                    }}</span>
                </inertia-link>
            </div>
            <b-nav tabs class="mb-4 flex-column flex-md-row">
                <li
                    class="nav-item"
                    v-for="(nav, index) in nav_items"
                    :key="index"
                >
                    <inertia-link
                        preserve-scroll
                        class="nav-link"
                        :class="{ active: nav.is_active }"
                        :href="nav.route"
                        v-text="nav.label"
                    ></inertia-link>
                </li>
            </b-nav>

            <div class="row user-panel-main">
                <div class="col-12 col-md-4" v-if="showProfile()">
                    <div class="sidebar">
                        <ProfileTabs :user="user" :tabs="tabs"></ProfileTabs>
                    </div>
                </div>
                <div
                    :class="{
                        'col-12 col-md-8': showProfile(),
                        'col-md-12': !showProfile()
                    }"
                >
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
            nav_items: this.getProp("nav_items"),
            showProfileValue: this.getProp("showProfile")
        };
    },
    methods: {
        showProfile() {
            return this.showProfileValue || this.tabs.length > 0;
        }
    }
};
</script>
