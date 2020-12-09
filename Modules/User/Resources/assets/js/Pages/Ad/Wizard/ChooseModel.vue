<template>
    <WizardStep :backLink="route('user.ad.create')">
        <form @submit.prevent>
            <p class="form-title">
                {{ __("ads.wizard.choose_model.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_model.desc") }}
            </p>

            <div class="row justify-content-center model-list">
                <div
                    class="model-item"
                    v-for="model in models"
                    :key="model.id"
                    :data-brand-id="model.id"
                >
                    <inertia-link
                        method="post"
                        :href="
                            route('user.ad.step_phone_model', {
                                phone_brand: brand.name
                            })
                        "
                        :data="{
                            phone_model: model.name
                        }"
                    >
                        <strong class="model-label">
                            {{ model.name }}
                        </strong>
                    </inertia-link>
                </div>
            </div>
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
            brand: this.getProp("brand"),
            models: this.getProp("models"),
            ad: this.getProp("ad")
        };
    }
};
</script>
