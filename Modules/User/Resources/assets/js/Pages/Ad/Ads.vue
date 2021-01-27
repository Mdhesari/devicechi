<template>
    <authLayout :user="user">
        <section class="page-title-container mb-4">
            <div class="container">
                <h1 class="page-title">آگهی ها فروش گوشی</h1>
            </div>
        </section>

        <SearchSection />

        <FilterSection />

        <section class="normal-adssection">
            <div class="container">
                <div class="main-title">
                    <h3>
                        آگهی ها
                    </h3>
                </div>
                <div class="row normal-ads">
                    <NormalAd
                        v-for="ad in ads"
                        :key="ad.id"
                        :ad="ad"
                        :countAds="ads.length"
                    ></NormalAd>
                </div>
            </div>
        </section>
    </authLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import NormalAd from "../../Components/Ads/NormalAd";
import SearchSection from "../../Section/Ad/Search";
import FilterSection from "../../Section/Ad/Filter";

export default {
    components: {
        AuthLayout,
        NormalAd,
        SearchSection,
        FilterSection
    },
    props: ["ads", "proAds", "user"]
};
</script>
