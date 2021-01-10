<template>
    <WizardStep
        :backLink="
            route('user.ad.create', {
                ad: ad.slug
            })
        "
    >
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
                                    phone_brand: brand.name,
                                    ad: ad.slug ? ad.slug : null
                                })
                            "
                            :data="{
                                phone_model: ad_model.name
                            }"
                        >
                            <strong class="model-label">
                                {{ ad_model.name }}
                            </strong>
                        </inertia-link>
                    </div>
                </div>
            </div>

            <b-form-group class="mb-4">
                <b-form-input
                    v-model="search"
                    :placeholder="__('ads.form.placeholder.models.search')"
                    type="search"
                    @keyup.delete="restoreModels"
                    @keyup="searchModels"
                ></b-form-input>
            </b-form-group>

            <div class="row justify-content-center model-list">
                <b-alert
                    variant="warning"
                    class="d-block mx-auto"
                    :show="!isLoading && models.length < 1"
                >
                    {{
                        __("ads.form.warning.nothing.models", {
                            model_name: search
                        })
                    }}
                </b-alert>

                <div
                    v-if="!isLoading"
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
                                ad: ad.slug ? ad.slug : null
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

            <Spinner v-if="isLoading" />
        </form>
    </WizardStep>
</template>

<script>
import WizardStep from "../../../Components/WizardStep";
import Spinner from "../../../Components/Spinner-progressing";

export default {
    components: {
        WizardStep,
        Spinner
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
            ad: this.getProp("ad"),
            search: "",
            isLoading: false
        };
    },
    methods: {
        modelsRequest(search = null) {
            this.isLoading = true;

            const brand_id = this.brand.id;

            setTimeout(() => {
                axios
                    .get(
                        route("user.ad.get.models", {
                            search: search,
                            brand_id: brand_id
                        })
                    )
                    .then(response => {
                        const data = response.data;

                        if (data.models) this.models = data.models;

                        this.isLoading = false;
                    });
            }, 1500);
        },
        searchModels() {
            if (this.search.length < 2) return;

            this.modelsRequest(this.search);
        },
        restoreModels() {
            if (this.search.length > 2) return;

            this.modelsRequest();
        }
    }
};
</script>
