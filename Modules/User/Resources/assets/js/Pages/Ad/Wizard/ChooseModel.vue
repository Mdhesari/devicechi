<template>
    <WizardStep :backLink="route('user.ad.create')">
        <form @submit.prevent>
            <p class="form-title">
                {{ __("ads.wizard.choose_model.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_model.desc") }}
            </p>

            <div class="row model-user" v-if="ad_model">
                <div class="col-12">
                    <h3 v-html="__('ads.section.selection.model')"></h3>
                </div>

                <div
                    class="row justify-content-center model-list"
                    :data-model-id="ad_model.id"
                >
                    <div class="model-item mx-4">
                        <inertia-link
                            method="post"
                            :href="
                                route('user.ad.step_phone_model', {
                                    ad: ad.id ? ad.id : null,
                                    phone_brand: brand.name
                                })
                            "
                        >
                            <strong class="model-label">
                                {{ ad_model.name }}
                            </strong>
                        </inertia-link>
                    </div>
                </div>
            </div>

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
                                phone_brand: brand.name,
                                ad: ad.id ? ad.id : null
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
    computed: {
        ad_model() {
            const ad = this.ad;

            if (!ad || !ad.phone_model) return null;

            return ad.phone_model;
        }
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
