<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ $t.get("ads.wizard.choose_variant.title") }}
            </p>
            <p class="form-desc">
                {{ $t.get("ads.wizard.choose_variant.desc") }}
            </p>

            <div class="errors">
                <p class="m-2 text-danger">{{ form.error("variant_id") }}</p>
            </div>

            <b-form-group class="text-center">
                <b-form-radio
                    class="mx-4"
                    name="phone_variant"
                    v-for="variant in variants"
                    :key="variant.id"
                    :value="variant.id"
                    size="lg"
                    inline
                    @change="next"
                >
                    {{ printVariantInfo(variant) }}
                </b-form-radio>
            </b-form-group>
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
            form: this.$inertia.form({
                variant_id: 0
            }),
            variants: this.$inertia.page.props.phone_model_variants,
            routes: this.$inertia.page.props.routes,
            current_root: this.$inertia.page.props.current_root
        };
    },
    methods: {
        next(variant_id) {
            this.form.variant_id = variant_id;

            this.form.post(this.routes.storeVariant);

            // this.$emit("next");
        },
        printVariantInfo(variant) {
            return variant.ram + " / " + variant.storage;
        }
    }
};
</script>
