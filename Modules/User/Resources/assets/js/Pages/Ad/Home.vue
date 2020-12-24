<template>
    <authLayout :user="user">
        <section class="about-us-section">
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
        <section class="search-bar-section">
            <div class="mini-container">
                <div class="search-bar">
                    <input type="text" placeholder="دنبال چه گوشی می گردی " />
                    <button type="button" class="icon">
                        <img src="img/search.svg" alt="" />
                    </button>
                </div>
                <!-- <div class="filter-bar">
                    <form action="#" class="filters">
                         <div class="filter">
                            <input type="checkbox" id="filter" name="" class="filter-input" >
                            <label for="filter" class="filter-label">فیلتر 1</label>
                         </div>
                         <div class="filter">
                            <input type="checkbox" id="filter" name="" class="filter-input" >
                            <label for="filter" class="filter-label">فیلتر 1</label>
                         </div>
                         <div class="filter">
                            <input type="checkbox" id="filter" name="" class="filter-input" >
                            <label for="filter" class="filter-label">فیلتر 1</label>
                         </div>
                    </form>
                </div> -->
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
                    <div class="col-md-4 ad">
                        <div class="inner">
                            <div class="ad-img">
                                <a
                                    href="#"
                                    style="background-image: url('img/1.jpg');"
                                ></a>
                            </div>
                            <div class="bookmark">
                                <i class="fa-bookmark far "></i>
                            </div>
                            <div class="ad-content">
                                <div class="ad-name">
                                    آیفون 6
                                </div>
                                <div class="ad-price">
                                    <span>2000,000</span>
                                    هزارتومان
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ad">
                        <div class="inner">
                            <div class="ad-img">
                                <a
                                    href="#"
                                    style="background-image: url('img/1.jpg');"
                                ></a>
                            </div>
                            <div class="bookmark">
                                <i class="fa-bookmark far "></i>
                            </div>
                            <div class="ad-content">
                                <div class="ad-name">
                                    آیفون 6
                                </div>
                                <div class="ad-price">
                                    <span>2000,000</span>
                                    هزارتومان
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ad">
                        <div class="inner">
                            <div class="ad-img">
                                <a
                                    href="#"
                                    style="background-image: url('img/1.jpg');"
                                ></a>
                            </div>
                            <div class="bookmark">
                                <i class="fa-bookmark far "></i>
                            </div>
                            <div class="ad-content">
                                <div class="ad-name">
                                    آیفون 6
                                </div>
                                <div class="ad-price">
                                    <span>2000,000</span>
                                    هزارتومان
                                </div>
                            </div>
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
                    ></NormalAd>
                </div>
            </div>
        </section>
    </authLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import NormalAd from "../../Components/Ads/NormalAd";

export default {
    components: {
        AuthLayout,
        NormalAd
    },
    props: ["ads", "user"]
};
</script>
