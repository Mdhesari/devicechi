<template>
    <div class="col-md-4 ad">
        <div class="inner">
            <div class="ad-img">
                <inertia-link
                    :href="
                        route('user.ad.show', {
                            ad: ad.id
                        })
                    "
                    :style="`background-image: url('${renderAdPicture(ad)}');`"
                ></inertia-link>
            </div>
            <div class="bookmark">
                <i class="fa-bookmark far "></i>
            </div>
            <div class="ad-content">
                <div class="ad-name">
                    {{ ad.title }}
                </div>
                <div class="ad-price">
                    <span>{{ ad.price }}</span>
                    هزارتومان
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AdPictureHelpers from "../../Mixins/AdPictureHelpers.js";

export default {
    props: ["ad"],
    mixins: [AdPictureHelpers]
};
</script>
