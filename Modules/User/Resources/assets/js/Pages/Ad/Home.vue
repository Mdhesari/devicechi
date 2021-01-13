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
                    <ProAd v-for="ad in ads" :key="ad.id" :ad="ad"></ProAd>
                </div>
            </div>
        </section>
        <section class="search-bar-section">
            <div class="mini-container">
                <div class="search-bar">
                    <input type="text" placeholder="دنبال چه گوشی می گردی " />
                    <button type="button" class="icon">
                        <img src="../../../img/search.svg" alt="Search" />
                    </button>
                </div>
            </div>
        </section>
        <section class="filter-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="filter-price">
                            <div class="range" id="slider-snap-value-lower">
                                <span class="number"></span>
                                میلیون تومان
                            </div>
                            <div class="range" id="slider-snap-value-higher">
                                <span class="number"></span>
                                میلیون تومان
                            </div>
                            <div
                                id="slider"
                                class="noUi-target noUi-ltr noUi-horizontal"
                            ></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="filter-model">
                            <select class="form-control form-control-sm">
                                <option disabled="disabled" selected="true">
                                    مدل موبایل مورد نظر</option
                                >
                                <option value="">اپل</option>
                                <option value="">سامسونگ</option>
                                <option value="">هواوی</option>
                                <option value="">شیائومی</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="filter-city">
                            <select class="form-control form-control-sm">
                                <option disabled="disabled" selected="true"
                                    >شهر مورد نظر</option
                                >
                                <option value="">تهران</option>
                                <option value="">تبریز</option>
                                <option value="">اصفهان</option>
                                <option value="">اهواز </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
import ProAd from "../../Components/Ads/ProAd";

export default {
    components: {
        AuthLayout,
        NormalAd,
        ProAd
    },
    props: ["ads", "user"]
};
</script>
