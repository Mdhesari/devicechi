<template>
    <WizardStep :backLink="route('user.ad.step_phone_accessories')">
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_age.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_age.desc") }}
            </p>

            <div class="errors">
                <p class="m-2 text-danger">{{ form.error("age_id") }}</p>
            </div>

            <b-form-group class="text-center mobile-radio-form-group">
                <b-form-radio
                    class="mx-4"
                    name="phone_variant"
                    v-for="age in phone_ages"
                    :key="age.id"
                    :value="age.id"
                    size="lg"
                    inline
                    @change="next"
                >
                    {{ printAgeInfo(age) }}
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
            isLoading: false,
            form: this.$inertia.form({
                age_id: 0
            }),
            phone_ages: this.getProp("phone_ages")
        };
    },
    methods: {
        next(age_id) {
            if (this.isLoading) return;

            this.isLoading = true;
            this.form.age_id = age_id;

            this.form
                .post(route("user.ad.step_phone_age"), {
                    preserveState: false
                })
                .then(response => {
                    this.isLoading = false;
                });

            // this.$emit("next");
        },
        printAgeInfo(age) {
            let txt = "";

            if (age.from == "-") {
                txt = this.__("ads.form.label.age.min", {
                    month: age.to
                });
            } else if (age.to == "+") {
                txt = this.__("ads.form.label.age.max", {
                    month: age.from
                });
            } else {
                txt = this.__("ads.form.label.age.between", {
                    min: age.from,
                    max: age.to
                });
            }

            return txt;
        }
    }
};
</script>
