<template>
    <WizardStep>
        <form @submit.prevent>
            <p class="form-title">{{ $t.get("ads.wizard.choose_model.title") }}</p>
            <p class="form-desc">
                {{ $t.get("ads.wizard.choose_model.desc") }}
            </p>
            <b-button
            v-if="isContinue"
            variant="secondary"
            >
            {{ $t.get('ads.wizard.btn.continue') }}
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
            isContinue: true,
        };
    }
};
</script>
