<template>
    <WizardStep
        :backLink="
            route('user.ad.step_phone_model', {
                phone_brand: brand.name
            })
        "
    >
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

            <b-form-group class="text-center mobile-radio-form-group">
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
            variants: this.getProp("phone_model_variants"),
            current_root: this.getProp("current_root"),
            model: this.getProp("model"),
            brand: this.getProp("brand")
        };
    },
    methods: {
        next(variant_id) {
            this.form.variant_id = variant_id;

            this.form.post(
                route("user.ad.step_phone_model_variant", {
                    phone_model: this.model.name
                }),
                {
                    preserveState: false
                }
            );

            // axios
            //     .post(
            //         route("user.ad.step_phone_model_variant", {
            //             phone_model: this.model.name
            //         }),
            //         {
            //             variant_id
            //         }
            //     )
            //     .then(response => {
            //         this.$inertia.visit(response.data.url);
            //     })
            //     .catch(err => console.log(err.response.data));

            // this.$emit("next");
        },
        printVariantInfo(variant) {
            return variant.ram + " / " + variant.storage;
        }
    }
};
</script>
