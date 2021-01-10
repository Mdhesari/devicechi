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
                                ad: ad.slug ? ad.slug : null
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

            <b-form-group class="mb-4" label-for="input-formatter">
                <b-form-input
                    v-model="search"
                    :placeholder="__('ads.form.placeholder.brands.search')"
                    type="search"
                    @keyup.delete="restoreBrands"
                    @keyup="searchBrands"
                ></b-form-input>
            </b-form-group>

            <div class="row brand-list" v-if="!isLoading">
                <b-alert
                    variant="warning"
                    class="d-block mx-auto"
                    :show="brands.length < 1"
                >
                    {{
                        __("ads.form.warning.nothing.brands", {
                            brand: search
                        })
                    }}
                </b-alert>

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
                                phone_brand: brand.name,
                                ad: ad
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

            <Spinner v-if="isLoading" />
        </form>
    </WizardStep>
</template>

<script>
import WizardStep from "../../../Components/WizardStep";
import Spinner from "../../../Components/Spinner-progressing";

export default {
    components: {
        WizardStep,
        Spinner
    },
    data() {
        return {
            brands: this.getProp("phone_brands"),
            ad: this.getProp("ad"),
            search: "",
            isLoading: false
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
        },
        brandRequest(search = null) {
            this.isLoading = true;

            axios
                .get(
                    route("user.ad.get.brands", {
                        search: search
                    })
                )
                .then(response => {
                    const data = response.data;

                    if (data.brands) this.brands = data.brands;

                    this.isLoading = false;
                });
        },
        searchBrands() {
            if (this.search.length < 3) return;

            this.brandRequest(this.search);
        },
        restoreBrands() {
            if (this.search.length > 3) return;

            this.brandRequest();
        }
    }
};
</script>
