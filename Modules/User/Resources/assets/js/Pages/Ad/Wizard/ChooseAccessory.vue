<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_accessory.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_accessory.desc") }}
            </p>

            <div class="row list-accessories">
                <b-form-checkbox
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
            selected: [],
            props: this.$inertia.page.props,
            accessories: this.$inertia.page.props.accessories,
            current_root: this.$inertia.page.props.current_root
        };
    },
    methods: {
        next() {
            // this.$emit("next");
            console.log(this.selected);

            this.$inertia.post(route("user.ad.step_phone_accessories"), {
                accessories: this.selected
            });
        }
    }
};
</script>
