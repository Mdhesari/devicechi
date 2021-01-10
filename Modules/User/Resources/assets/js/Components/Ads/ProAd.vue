<template>
    <div class="col-md-4 ad">
        <inertia-link
            class="ad-img"
            :href="
                route('user.ad.show', {
                    ad: ad.slug
                })
            "
            :style="`background-image: url('${renderAdPicture(ad)}');`"
        >
            <div class="inner">
                <div class="bookmark">
                    <i class="fa-bookmark far "></i>
                </div>
                <div class="ad-content">
                    <div class="ad-name">
                        {{ ad.title }}
                    </div>
                    <div class="ad-price">
                        <span>{{ formatMoney(ad.price) }}</span>
                        هزارتومان
                    </div>
                </div>
            </div>
        </inertia-link>
    </div>
</template>

<script>
import AdPictureHelpers from "../../Mixins/AdPictureHelpers.js";

export default {
    props: ["ad"],
    mixins: [AdPictureHelpers]
};
</script>
