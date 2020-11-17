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
                id="input-group-cities"
                :label="__('ads.form.label.location.city')"
                label-for="phone-city"
            >
                <b-form-select
                    id="phone-city"
                    v-model="form.city"
                    :options="cities"
                    @change="loadCityStates"
                ></b-form-select>
            </b-form-group>

            <b-form-group
                v-if="form.city"
                id="input-group-states"
                :label="__('ads.form.label.location.state')"
                label-for="phone-state"
            >
                <b-form-select
                    id="phone-state"
                    v-model="form.state"
                    :options="states"
                ></b-form-select>
            </b-form-group>

            <b-button
                v-if="form.state"
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
                city: null,
                state: null
            }),
            allCities: this.getProp("cities"),
            states: [
                {
                    value: null,
                    text: this.__("ads.form.placeholder.location.city")
                }
            ]
        };
    },
    computed: {
        cities() {
            let cities = [
                {
                    value: null,
                    text: this.__("ads.form.placeholder.location.city")
                }
            ];

            this.allCities.forEach(city => {
                cities.push({
                    value: city.id,
                    text: city.name
                });
            });

            return cities;
        }
    },
    methods: {
        next(ev) {
            // this.$emit("next");
        },
        loadCityStates() {
            let city_id = this.form.city;

            //
        }
    }
};
</script>
