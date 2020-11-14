<template>
    <WizardStep>
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_price.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_price.desc") }}
            </p>

            <b-form-group
                id="input-group-1"
                :label="__('ads.form.label.price')"
                label-for="phone-price"
            >
                <b-form-input
                    id="phone-price"
                    v-model="form.price"
                    type="number"
                    required
                    @keyup="calculatePrice"
                    :placeholder="__('ads.form.placeholder.price')"
                ></b-form-input>
                <small
                    class="form-text text-muted"
                    v-text="calculated_price"
                ></small>
            </b-form-group>

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
            form: this.$inertia.form({
                price: ""
            }),
            calculated_price: "",
            current_root: this.$inertia.page.props.current_root
        };
    },
    methods: {
        next(variant_id) {
            // this.$emit("next");
        },
        calculatePrice() {
            if (Number(this.form.price) > 0)
                this.calculated_price =
                    this.formatMoney(this.form.price) + " تومان";
            else this.calculated_price = "";
        }
    }
};
</script>
