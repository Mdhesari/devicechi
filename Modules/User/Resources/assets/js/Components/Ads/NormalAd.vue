<template>
    <div class="normal-ad col-sm-6 col-md-4">
        <inertia-link
            :href="
                route('user.ad.show', {
                    ad: ad.slug
                })
            "
        >
            <div class="inner">
                <div class="thumbnail">
                    <img
                        :src="renderAdPicture(ad, 'thumb_url')"
                        :alt="ad.title"
                    />
                    <div class="bookmark">
                        <i class="fa-bookmark far" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="details">
                    <h5 class="ad-name ">
                        {{ ad.title }}
                    </h5>
                    <div class="ad-price text-muted mt-4">
                        {{ formatMoney(ad.price) }}
                        <span>تومان</span>
                    </div>
                    <p class="publish-time text-muted" v-if="ad.state">
                        <span>
                            {{ moment(ad.created_at).fromNow() }}
                        </span>
                        <span>در</span>
                        <span v-text="ad.state.city.name"></span>
                        <span>,</span>
                        <span v-text="ad.state.name"></span>
                    </p>
                    <slot></slot>
                </div>
            </div>
        </inertia-link>
    </div>
</template>

<script>
import AdPictureHelpers from "../../Mixins/AdPictureHelpers.js";

export default {
    props: ["ad", "countAds"],
    mixins: [AdPictureHelpers]
};
</script>
