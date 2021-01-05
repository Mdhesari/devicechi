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
                                {{ moment(ad.created_at).fromNow() }}
                            </span>
                            <span>در</span>
                            <span v-text="ad.state.city.name"></span>
                            <span>,</span>
                            <span v-text="ad.state.name"></span>
                        </div>
                        <div class="actions my-4">
                            <div class="call">
                                <a href="tel:09190790979" class=" btn call-btn"
                                    >تماس با آگهی دهنده</a
                                >
                            </div>
                        </div>
                        <div class="specs">
                            <ul class="infos-phone">
                                <li class="inner">
                                    <div class="title">قیمت</div>
                                    <div class="value">
                                        {{ formatMoney(ad.price) }}
                                        <span>تومان</span>
                                    </div>
                                </li>
                                <!--
                                <li class="inner">
                                    <div class="title">رنگ</div>
                                    <div class="value">سیلور</div>
                                </li>
                                -->

                                <li class="inner">
                                    <div class="title">حافظه داخلی / رم</div>
                                    <div class="value">
                                        {{ printVariantInfo(ad.variant) }}
                                    </div>
                                </li>
                                <li class="inner">
                                    <div class="title">وضعیت</div>
                                    <div class="value">موجود</div>
                                </li>
                                <li class="inner">
                                    <div class="title">برند</div>
                                    <div class="value">
                                        {{ ad.phone_model.brand.name }}
                                    </div>
                                </li>
                                <li class="inner">
                                    <div class="title">مدل</div>
                                    <div class="value">
                                        {{ ad.phone_model.name }}
                                    </div>
                                </li>
                                <li class="inner">
                                    <div class="title">
                                        پشتیبانی از چند سیمکارت
                                    </div>
                                    <div class="value">
                                        {{ ad.is_multicard_read }}
                                    </div>
                                </li>
                                <li class="inner">
                                    <div class="title">قابل معاوضه</div>
                                    <div class="value">
                                        {{ ad.is_exchangeable_read }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="des">
                            <h4>توضیحات</h4>
                            <p v-html="ad.description"></p>
                        </div>
                        <HamtaAlert />
                    </div>
                </div>
                <div class="col-12 col-lg-6 gallery-post links">
                    <AdPostGallery :pictures="ad.pictures" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import AdPostGallery from "./AdPostGallery";
import HamtaAlert from "../Section/HamtaAlert";

export default {
    props: ["ad"],
    components: {
        AdPostGallery,
        HamtaAlert
    },
    methods: {
        printVariantInfo(variant) {
            return variant.storage + " / " + variant.ram;
        }
    }
};
</script>
