<template>
    <WizardStep :backLink="route('user.ad.step_phone_pictures')">
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_location.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_location.desc") }}
            </p>

            <b-form-group
                id="input-group-1"
                :label="__('ads.form.label.location.city')"
                label-for="phone-location"
            >
                <b-form-select
                    id="phone-location"
                    v-model="selectedCity"
                    :options="cities"
                ></b-form-select>
            </b-form-group>

            <b-button
                v-if="selectedCity !== null"
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
            form: this.$inertia.form({
                city: "",
                state: ""
            }),
            selectedCity: null,
            cities: [
                {
                    value: null,
                    text: this.__("ads.form.placeholder.location.city")
                },
                {
                    value: "tehran",
                    text: "تهران"
                }
            ]
        };
    },
    methods: {
        next(ev) {
            // this.$emit("next");
        }
    }
};
</script>
