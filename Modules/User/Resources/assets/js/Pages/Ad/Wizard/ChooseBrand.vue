<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_brand.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_brand.desc") }}
            </p>

            <div class="row brand-user" v-if="ad_brand">
                <div class="col-12">
                    <h3 v-html="__('ads.section.selection.brand')"></h3>
                </div>

                <div
                    class="col-6 col-sm-4 col-md-3 col-lg-2 brand-item"
                    :data-brand-id="ad_brand.id"
                >
                    <inertia-link
                        method="get"
                        :href="
                            route('user.ad.step_phone_model', {
                                phone_brand: ad_brand.name,
                                ad: ad.id ? ad.id : null
                            })
                        "
                    >
                        <img
                            :src="url(ad_brand.picture_path)"
                            :alt="ad_brand.name"
                        />
                        <h4 class="brand-label">
                            {{ ad_brand.name }}
                        </h4>
                    </inertia-link>
                </div>
            </div>

            <div class="row brand-list">
                <div
                    class="col-6 col-sm-4 col-md-3 col-lg-2 brand-item"
                    v-for="brand in brands"
                    :key="brand.id"
                    :data-brand-id="brand.id"
                >
                    <inertia-link
                        method="get"
                        :href="
                            route('user.ad.step_phone_model', {
                                phone_brand: brand.name
                            })
                        "
                    >
                        <img :src="url(brand.picture_path)" :alt="brand.name" />
                        <h4 class="brand-label">
                            {{ brand.name }}
                        </h4>
                    </inertia-link>
                </div>
            </div>
        </form>
    </WizardStep>
</template>

<script>
import WizardStep from "../../../Components/WizardStep";

export default {
    components: {
        WizardStep
    },
    data() {
        return {
            brands: this.getProp("phone_brands"),
            current_root: this.getProp("current_root"),
            ad: this.getProp("ad")
        };
    },
    computed: {
        ad_brand() {
            const ad = this.ad;

            if (!ad || !ad.phone_model) return null;

            return ad.phone_model.brand;
        }
    },
    methods: {
        next() {
            // this.$emit("next");
        }
    }
};
</script>
