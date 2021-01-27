<template>
    <authLayout :user="user">
        <section class="about-us-section d-none">
            <div class="mini-container">
                <div class="about-us">
                    <p>
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                        چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون
                        بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و
                        برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با
                        هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت
                        و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و
                        متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را
                        برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ
                        پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید
                        داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط
                        سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی
                        دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود
                        طراحی اساسا مورد استفاده قرار گیرد.
                    </p>
                </div>
            </div>
        </section>
        <section class="ads-section">
            <div class="container">
                <div class="main-title">
                    <h3>
                        آگهی های ویژه
                    </h3>
                </div>
                <div class="row ads-holder">
                    <ProAd v-for="ad in proAds" :key="ad.id" :ad="ad"></ProAd>
                </div>
            </div>
        </section>

        <SearchSection />

        <section class="normal-adssection mt-4">
            <div class="container">
                <div class="main-title">
                    <h3>
                        آگهی ها
                    </h3>
                </div>
                <div class="row normal-ads">
                    <NormalAd
                        v-for="ad in allAds.data"
                        :key="ad.id"
                        :ad="ad"
                        :countAds="ads.length"
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
