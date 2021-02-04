<template>
    <authLayout :user="user">
        <SearchSection class="mt-4" />

        <section class="ads-section">
            <div class="container">
                <div class="main-title">
                    <h3>
                        {{ __("ads.latest-pro") }}
                    </h3>
                </div>
                <div class="row ads-holder">
                    <ProAd v-for="ad in proAds" :key="ad.id" :ad="ad"></ProAd>
                </div>
            </div>
        </section>

        <section class="normal-adssection mt-4">
            <div class="container">
                <div class="main-title">
                    <h3>
                        {{ __("ads.latest") }}
                    </h3>
                </div>
                <div class="row normal-ads">
                    <NormalAd
                        v-for="ad in allAds.data"
                        :key="ad.id"
                        :ad="ad"
                        :countAds="allAds.data.length"
                    ></NormalAd>
                </div>

                <Pagination
                    size="default"
                    align="center"
                    :data="allAds"
                    @pagination-change-page="getResults"
                ></Pagination>
            </div>
        </section>
    </authLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import NormalAd from "../../Components/Ads/NormalAd";
import ProAd from "../../Components/Ads/ProAd";
import SearchSection from "../../Section/Ad/Search";
import Pagination from "laravel-vue-pagination";

export default {
    components: {
        AuthLayout,
        NormalAd,
        ProAd,
        SearchSection,
        Pagination
    },
    data() {
        return {
            allAds: this.getProp("ads")
        };
    },
    props: ["ads", "proAds", "user"],
    methods: {
        getResults(page = 1) {
            axios
                .get(
                    route("user.ad.home", {
                        page
                    })
                )
                .then(response => {
                    this.allAds = response.data;
                });
        }
    }
};
</script>
