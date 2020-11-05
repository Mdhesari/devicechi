<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ $t.get("ads.wizard.choose_brand.title") }}
            </p>
            <p class="form-desc">
                {{ $t.get("ads.wizard.choose_brand.desc") }}
            </p>
            <b-button v-if="isContinue" variant="secondary" type="submit">
                {{ $t.get("ads.wizard.btn.continue") }}
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
            title: "",
            isContinue: true
        };
    },
    methods: {
        next() {
            this.$emit("next");
        }
    }
};
</script>
