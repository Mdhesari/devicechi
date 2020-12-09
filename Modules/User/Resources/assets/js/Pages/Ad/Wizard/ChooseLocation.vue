<template>
    <WizardStep
        :backLink="
            route('user.ad.step_phone_pictures', {
                ad: ad.id
            })
        "
    >
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
                city: this.getProp("city") ? this.getProp("city").id : null,
                state: this.getProp("state") ? this.getProp("state").id : null
            }),
            allCities: this.getProp("cities"),
            allStates: this.getProp("states"),
            ad: this.getProp("ad")
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
        },
        states() {
            let states = [
                {
                    value: null,
                    text: this.__("ads.form.placeholder.location.state_loading")
                }
            ];

            this.allStates.forEach(state => {
                states.push({
                    value: state.id,
                    text: state.name
                });
            });

            return states;
        }
    },
    methods: {
        next(ev) {
            // this.$emit("next");

            this.form
                .post(
                    this.route("user.ad.step_phone_location", {
                        ad: this.ad.id
                    }),
                    {
                        preserveScroll: true
                    }
                )
                .then(response => {
                    if (this.form.error("city")) {
                        this.$to(
                            this.__("ads.form.error.location.city.title"),
                            this.__("ads.form.error.location.city.desc")
                        );
                    } else if (this.form.error("state")) {
                        this.$to(
                            this.__("ads.form.error.location.state.title"),
                            this.__("ads.form.error.location.state.desc")
                        );
                    }
                });
        },
        async loadCityStates(id) {
            this.form.state = null;

            this.states[0].text = this.__(
                "ads.form.placeholder.location.state_loading"
            );

            const response = await axios.get(
                route("user.ad.step_phone_location.states", {
                    ad: this.ad.id,
                    city: id
                })
            );

            if (response.status == 200 && response.data.status) {
                this.states[0].text = this.__(
                    "ads.form.placeholder.location.state"
                );

                response.data.states.forEach(state => {
                    this.states.push({
                        value: state.id,
                        text: state.name
                    });
                });
            }
        }
    }
};
</script>
