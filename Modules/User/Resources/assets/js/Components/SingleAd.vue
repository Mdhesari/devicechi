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
                            <span>در</span>
                            <span v-text="ad.state.name"></span>
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
                    <AdPostGallery :pictures="ad.pictures" /> 
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import AdPostGallery from "./AdPostGallery";

export default {
    props: ["ad"],
    components: {
        AdPostGallery
    },
    methods: {
        printVariantInfo(variant) {
            return variant.storage + " / " + variant.ram;
        }
    }
};
</script>
