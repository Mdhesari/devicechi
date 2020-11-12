<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ $t.get("ads.wizard.choose_brand.title") }}
            </p>
            <p class="form-desc">
                {{ $t.get("ads.wizard.choose_brand.desc") }}
            </p>

            <div class="row brand-list">
                <div
                    class="col-md-2 brand-item"
                    v-for="brand in brands"
                    :key="brand.id"
                    :data-brand-id="brand.id"
                >
                    <inertia-link
                        :href="
                            route('user.ad.step_phone_model', {
                                phone_brand: brand.name
                            })
                        "
                    >
                        <img
                            :src="current_root + '/' + brand.picture_path"
                            alt="Apple"
                        />
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
            brands: this.$inertia.page.props.phone_brands,
            current_root: this.$inertia.page.props.current_root
        };
    },
    methods: {
        next() {
            // this.$emit("next");
        }
    }
};
</script>
