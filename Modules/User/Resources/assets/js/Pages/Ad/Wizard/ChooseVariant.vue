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
                    v-model="form.variant_id"
                    size="lg"
                    :disabled="isLoading"
                    inline
                    @change="nextUsingChange"
                >
                    {{ printVariantInfo(variant) }}
                </b-form-radio>
            </b-form-group>

            <b-button
                v-if="form.variant_id"
                :disabled="isLoading"
                variant="secondary"
                @click.prevent="next"
            >
                {{ __("global.next") }}
            </b-button>
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
            variants: this.getProp("phone_model_variants"),
            current_root: this.getProp("current_root"),
            model: this.getProp("model"),
            brand: this.getProp("brand"),
            ad: this.getProp("ad"),
            isLoading: false
        };
    },
    computed: {
        form() {
            return this.$inertia.form({
                variant_id: this.ad.phone_model_variant_id
                    ? this.ad.phone_model_variant_id
                    : null
            });
        }
    },
    mounted() {
        console.log(this.form.variant_id);
    },
    methods: {
        next() {
            this.isLoading = true;

            this.form
                .post(
                    route("user.ad.step_phone_model_variant", {
                        phone_model: this.model.name
                    })
                )
                .then(response => {
                    this.isLoading = false;
                });
        },
        nextUsingChange(variant_id) {
            this.form.variant_id = variant_id;

            this.next();
        },
        printVariantInfo(variant) {
            return variant.ram + " / " + variant.storage;
        }
    }
};
</script>
