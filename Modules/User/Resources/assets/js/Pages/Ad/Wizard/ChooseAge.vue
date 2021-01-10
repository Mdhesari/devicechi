<template>
    <WizardStep
        :backLink="
            route('user.ad.step_phone_accessories', {
                ad: ad.slug
            })
        "
    >
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
                    :disabled="isLoading"
                    v-model="form.age_id"
                    size="lg"
                    inline
                    @change="nextUsingChange"
                >
                    {{ printAgeInfo(age) }}
                </b-form-radio>
            </b-form-group>

            <b-button
                v-if="form.age_id"
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
            isLoading: false,
            phone_ages: this.getProp("phone_ages"),
            ad: this.getProp("ad"),
            form: this.$inertia.form({
                age_id: null
            })
        };
    },
    mounted() {
        this.form.age_id = this.ad.phone_age_id ? this.ad.phone_age_id : null;
    },
    methods: {
        next() {
            if (this.isLoading) return;

            this.isLoading = true;

            this.form
                .post(
                    route("user.ad.step_phone_age", {
                        ad: this.ad.slug
                    }),
                    {
                        preserveState: false
                    }
                )
                .then(response => {
                    this.isLoading = false;
                });

            // this.$emit("next");
        },
        nextUsingChange(age_id) {
            this.form.age_id = age_id;
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
