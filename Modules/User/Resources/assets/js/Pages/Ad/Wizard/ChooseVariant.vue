<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_variant.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_variant.desc") }}
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
            current_root: this.$inertia.page.props.current_root,
            model: this.$inertia.page.props.model
        };
    },
    methods: {
        next(variant_id) {
            this.form.variant_id = variant_id;

            this.form.post(
                route("user.ad.step_phone_model_variant", {
                    phone_model: this.model.name
                })
            );

            // this.$emit("next");
        },
        printVariantInfo(variant) {
            return variant.ram + " / " + variant.storage;
        }
    }
};
</script>
