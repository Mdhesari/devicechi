<template>
    <WizardStep
        :backLink="
            route('user.ad.step_phone_model_variant', {
                phone_model
            })
        "
    >
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_accessory.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_accessory.desc") }}
            </p>

            <div class="row list-accessories">
                <b-form-checkbox
                    :disabled="isLoading"
                    class="col-12 col-md-3 text-center"
                    v-for="(accessory, index) in accessories"
                    :key="accessory.id"
                    :name="'accessory_' + accessory.id"
                    v-model="selected[index]"
                    :value="accessory.id"
                >
                    <img
                        class="accessory-image"
                        :src="url(accessory.picture_path)"
                        :alt="accessory.title"
                    />
                    <h5 class="accessory-title mt-2">
                        {{ __("accessories." + accessory.title) }}
                    </h5>
                </b-form-checkbox>
            </div>

            <b-button variant="secondary" @click.preven="next">
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
            isLoading: false,
            selected: [],
            accessories: this.getProp("accessories"),
            current_root: this.getProp("current_root"),
            phone_model: this.getProp("phone_model")
        };
    },
    methods: {
        next() {
            // this.$emit("next");

            this.isLoading = true;

            this.$inertia
                .post(
                    route("user.ad.step_phone_accessories"),
                    {
                        accessories: this.selected
                    },
                    {
                        preserveState: false
                    }
                )
                .then(response => {
                    this.isLoading = false;
                });
        }
    }
};
</script>
