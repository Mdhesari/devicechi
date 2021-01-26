<template>
    <AuthLayout :user="user">
        <Panel :user="user" :tabs="tabs">
            <div class="row normal-ads mt-4" v-if="ads && !isLoading">
                <NormalAd
                    v-for="ad in ads"
                    :key="ad.id"
                    :ad="ad"
                    :countAds="ads.length"
                >
                    <p :class="`status ${renderStatusClass(ad.status)}`">
                        {{ renderStatusLabel(ad.status) }}
                    </p>
                    <inertia-link
                        :href="
                            route('user.ad.step_phone_demo', {
                                ad: ad.slug
                            })
                        "
                    >
                        ویرایش آگهی
                    </inertia-link>
                </NormalAd>

                <!-- <div class="col-md-6"></div> -->
            </div>

            <spinner v-if="isLoading" />

            <!-- No Content -->
            <b-alert
                v-if="!isLoading"
                :show="ads.length < 1"
                variant="info"
                class="text-center mt-4"
            >
                هیچ آگهی موجود نیست!
            </b-alert>
        </Panel>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import spinner from "../../Components/Spinner";
import Panel from "../../Section/Dashboard/Panel";
import AdPictureHelpers from "../../Mixins/AdPictureHelpers.js";
import NormalAd from "../../Components/Ads/NormalAd";

export default {
    components: {
        spinner,
        Panel,
        AuthLayout,
        NormalAd
    },
    props: ["user", "tabs"],
    mixins: [AdPictureHelpers],
    data() {
        return {
            ads: this.getProp("ads"),
            activeItem: null,
            isLoading: false
        };
    },
    methods: {
        renderStatusLabel(status) {
            return this.__(`ads.status.${status}.label`);
        },
        renderStatusClass(status) {
            return this.__(`ads.status.${status}.class`);
        },
        renderTitle(title) {
            return title !== null && title.length > 0
                ? title
                : this.__("ads.defaults.title");
        }
    }
};
</script>
