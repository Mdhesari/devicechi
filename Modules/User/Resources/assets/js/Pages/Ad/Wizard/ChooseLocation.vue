<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_location.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_location.desc") }}
            </p>
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
            current_root: this.getProp("current_root")
        };
    },
    methods: {
        next(variant_id) {
            // this.$emit("next");
        }
    }
};
</script>
