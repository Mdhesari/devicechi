<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ $t.get("ads.wizard.choose_age.title") }}
            </p>
            <p class="form-desc">
                {{ $t.get("ads.wizard.choose_age.desc") }}
            </p>

            <div class="errors">
                <p class="m-2 text-danger">{{ form.error("age_id") }}</p>
            </div>

            <b-form-group class="text-center">
                <b-form-radio
                    class="mx-4"
                    name="phone_variant"
                    v-for="age in ages"
                    :key="age.id"
                    :value="age.id"
                    size="lg"
                    inline
                    @change="next"
                >
                    {{ printVariantInfo(age) }}
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
                age_id: 0
            }),
            ages: this.$inertia.page.props.phone_model_ages,
            current_root: this.$inertia.page.props.current_root
        };
    },
    methods: {
        next(age_id) {
            this.form.age_id = age_id;

            this.form.post(route("user.ad.step_phone_age"));

            // this.$emit("next");
        },
        printVariantInfo(age) {
            return age.ram + " / " + age.storage;
        }
    }
};
</script>
