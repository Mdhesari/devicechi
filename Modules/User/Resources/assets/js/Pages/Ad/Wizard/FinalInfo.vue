<template>
    <WizardStep :backLink="route('user.ad.step_phone_contact')">
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.final_info.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.final_info.desc") }}
            </p>

            <b-form-group
                :label="__('ads.form.label.details.title')"
                label-for="title"
            >
                <b-form-input
                    type="text"
                    id="title"
                    required
                    v-model="form.title"
                    :placeholder="__('ads.form.placeholder.details.title')"
                ></b-form-input>
                <p class="text-danger" v-text="form.error('title')"></p>
            </b-form-group>

            <b-form-group
                :label="__('ads.form.label.details.description')"
                label-for="description"
                class="ad-description-form"
            >
                <b-form-textarea
                    id="description"
                    required
                    :placeholder="
                        __('ads.form.placeholder.details.description')
                    "
                    rows="30"
                    v-model="form.description"
                ></b-form-textarea>
                <p class="text-danger" v-text="form.error('description')"></p>
            </b-form-group>

            <b-button variant="secondary" @click.prevent="next">
                {{ __("global.next") }}
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
            form: this.$inertia.form({
                title: null,
                description: null
            })
        };
    },
    methods: {
        next() {
            this.form.post(route("user.ad.step_phone_details"));
        }
    }
};
</script>
