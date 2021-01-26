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
                            <GetContactList :ad="ad"></GetContactList>
                            <div class="btn-group btn-dock">
                                <ShareButton
                                    propId="copy-share-url"
                                    :shareUrl="ad.short_url"
                                ></ShareButton>
                                <SaveButton :ad="ad"></SaveButton>
                            </div>
                        </div>
                        <div class="specs">
                            <ul
                                class="list-group list-group-horizontal my-4 row accessories"
                            >
                                <li
                                    v-for="(accessory, index) in ad.accessories"
                                    :key="index"
                                    class="list-group-item col bg-transparent border-0"
                                >
                                    <img
                                        class="accessory-image"
                                        v-b-tooltip
                                        :title="
                                            __('accessories.' + accessory.title)
                                        "
                                        :src="url(accessory.picture_path)"
                                        :alt="accessory.title"
                                    />
                                </li>
                                <!-- <li
                                    v-for="(accessory, index) in accessories"
                                    :key="index"
                                    class="list-group-item bg-transparent border-0"
                                >
                                    <img
                                        class="accessory-image"
                                        :src="url(accessory.picture_path)"
                                        :alt="accessory.title"
                                    />
                                </li> -->
                            </ul>
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
                            <div v-html="adBody"></div>
                        </div>
                        <HamtaAlert class="my-4" />
                    </div>
                </div>
                <div class="col-12 col-lg-6 gallery-post links">
                    <AdPostGallery :pictures="ad.media" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import AdPostGallery from "./AdPostGallery";
import HamtaAlert from "../Section/HamtaAlert";
import GetContactList from "../Section/ContactList";
import ShareButton from "../Components/ShareButton";
import SaveButton from "../Components/SaveButton";
export default {
    props: {
        ad: {
            type: Object
        },
        accessories: {
            type: Array,
            default: []
        }
    },
    components: {
        AdPostGallery,
        HamtaAlert,
        GetContactList,
        ShareButton,
        SaveButton
    },
    computed: {
        adBody() {
            return this.ad.description.replace(/(?:\r\n|\r|\n)/g, "<br>");
        }
    },
    methods: {
        printVariantInfo(variant) {
            return variant.storage + " / " + variant.ram;
        }
    }
};
</script>
