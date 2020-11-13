<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_contact.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_contact.desc") }}
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
