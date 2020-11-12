<template>
    <WizardStep>
        <form @submit.prevent>
            <p class="form-title">
                {{ $t.get("ads.wizard.choose_model.title") }}
            </p>
            <p class="form-desc">
                {{ $t.get("ads.wizard.choose_model.desc") }}
            </p>

            <inertia-link
                :href="route('user.ad.create')"
                class="btn btn-link text-secondary"
            >
                {{ $t.get("global.back") }}
            </inertia-link>

            <div class="row brand-list">
                <div
                    class="col-md-2 brand-item"
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
                        <h4 class="brand-label">
                            {{ model.name }}
                        </h4>
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
            brand: this.$inertia.page.props.brand,
            models: this.$inertia.page.props.models
        };
    }
};
</script>
