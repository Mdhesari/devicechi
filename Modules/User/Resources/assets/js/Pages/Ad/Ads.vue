<template>
    <authLayout :user="user">
        <section class="page-title-container mb-4">
            <div class="container">
                <h1 class="page-title">آگهی ها فروش گوشی</h1>
                <p
                    class="text-lead mt-4"
                    v-if="search && search.length > 0"
                    v-text="`جستجو برای '${search}'`"
                ></p>
            </div>
        </section>

        <SearchSection :search="search" />

        <section class="normal-adssection mt-4">
            <div class="container">
                <div class="main-title">
                    <h3>
                        آگهی ها
                    </h3>
                </div>

                <!-- No Content -->
                <b-alert
                    :show="ads.length < 1"
                    variant="info"
                    class="text-center mt-4"
                >
                    هیچ آگهی موجود نیست!
                </b-alert>
                <div v-if="ads.length > 0" class="row normal-ads">
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
    props: ["ads", "proAds", "user", "search"]
};
</script>
