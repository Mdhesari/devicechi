<template>
    <section class="post-holder">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 single-post">
                    <div class="post-inner">
                        <div class="heading">
                            <h1>
                                {{ ad.title }}
                            </h1>
                        </div>
                        <div class="publish-time">
                            <span>
                                {{ ad.created_at }}
                            </span>
                        </div>
                        <div class="specs">
                            <ul class="infos-phone">
                                <li class="inner">
                                    <div class="title">قیمت :</div>
                                    <div class="value">
                                        {{ formatMoney(ad.price) }}
                                        <span>تومان</span>
                                    </div>
                                </li>
                                <!--
                                <li class="inner">
                                    <div class="title">رنگ :</div>
                                    <div class="value">سیلور</div>
                                </li>
                                -->
                                <li class="inner">
                                    <div class="title">حافظه داخلی :</div>
                                    <div class="value">64 گیگابایت</div>
                                </li>
                                <li class="inner">
                                    <div class="title">حافظه داخلی / رم</div>
                                    <div class="value">
                                        {{ printVariantInfo(ad.variant) }}
                                    </div>
                                </li>
                                <li class="inner">
                                    <div class="title">وضعیت :</div>
                                    <div class="value">موجود</div>
                                </li>
                                <li class="inner">
                                    <div class="title">برند :</div>
                                    <div class="value">
                                        {{ ad.phone_model.brand.name }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="des">
                            <p>
                                {{ ad.description }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 gallery-post links">
                    <div class="swiper-container " id="mainHomeSlider">
                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide main-gallery-bg main-img"
                                style="background-image: url('https://images.unsplash.com/photo-1574675904801-eb2cca16af12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1451&q=80');"
                            ></div>
                            <div
                                class="swiper-slide main-gallery-bg"
                                style="background-image: url('img/1.jpg');"
                            ></div>
                        </div>
                    </div>
                    <div class="swiper-container gallery-thumbs ">
                        <div class="swiper-wrapper">
                            <div
                                class="swiper-slide main-gallery-bg height100"
                                style="background-image: url('https://images.unsplash.com/photo-1574675904801-eb2cca16af12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1451&q=80');"
                            ></div>
                            <div
                                class="swiper-slide main-gallery-bg height100"
                                style="background-image: url('img/1.jpg');"
                            ></div>
                        </div>
                    </div>

                    <div class="short-links">
                        <div class="lable">
                            <strong>لینک کوتاه</strong>
                        </div>
                        <span class="short-link">
                            https://mobileforsale.com
                            <button class="clip-board">
                                <i class="fa fa-clone" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>
                    <div class="actions">
                        <div class="call">
                            <a href="tel:09190790979" class=" btn call-btn"
                                >تماس با آگهی دهنده</a
                            >
                        </div>
                        <div class="safe">
                            راهنمای معاله امن
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["ad"],
    methods: {
        printVariantInfo(variant) {
            return variant.storage + " / " + variant.ram;
        }
    }
};
</script>
