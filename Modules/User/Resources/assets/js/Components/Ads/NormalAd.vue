<template>
    <div class="col-md-3 normal-ad">
        <div class="inner">
            <div class="tumbnail">
                <img :src="renderAdPicture(ad)" :alt="ad.title" />
                <div class="bookmark">
                    <i class="fa-bookmark far" aria-hidden="true"></i>
                </div>
            </div>
            <div class="details">
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
