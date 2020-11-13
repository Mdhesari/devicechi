<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_price.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_price.desc") }}
            </p>

            <b-row class="my-1">
                <b-col sm="2">
                    <label for="input-large">
                        {{ __("ads.form.label.price") }}
                    </label>
                </b-col>
                <b-col sm="10">
                    <b-form-input
                        v-model="price"
                        id="input-large"
                        size="lg"
                        placeholder="Enter your name"
                    ></b-form-input>
                </b-col>
            </b-row>

            <b-button variant="secondary" @click.preven="next">
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
            price: 0,
            current_root: this.$inertia.page.props.current_root
        };
    },
    methods: {
        next(variant_id) {
            // this.$emit("next");
        }
    }
};
</script>
