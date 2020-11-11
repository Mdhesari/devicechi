<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ $t.get("ads.wizard.choose_accessory.title") }}
            </p>
            <p class="form-desc">
                {{ $t.get("ads.wizard.choose_accessory.desc") }}
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
            routes: this.$inertia.page.props.routes,
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
