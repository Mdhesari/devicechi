<template>
    <b-row>
        <confirm-modal
            v-on:reset-form="onReset"
            ref="confirmModal"
        ></confirm-modal>
        <b-col md="6">
            <div class="vector">
                <img
                    class="sale-vector"
                    src="../../img/vectors/sale-2.png"
                    alt="Sale Online | فروش آنلاین"
                />
            </div>
        </b-col>

        <b-col md="6" class="text-right">
            <b-form @submit="onSubmit" @reset="onReset" class="login-form">
                <b-form-group
                    class="phone_number"
                    :label="__('login.form.label')"
                >
                    <b-button
                        :disabled="isLoading"
                        type="submit"
                        variant="secondary"
                        class="btn-login-submit d-inline-block"
                    >
                        <BIconArrowRight
                            v-show="!isLoading"
                            style="vertical-align: middle"
                        ></BIconArrowRight>
                        <b-spinner v-show="isLoading"></b-spinner>
                    </b-button>
                    <b-form-input
                        @blur="!focusOnPhone"
                        v-model="form.phone"
                        type="tel"
                        minlength="6"
                        maxlength="10"
                        :disabled="isLoading"
                        class="input-phone-number mx-auto input-light-silver border-0 text-left dir-ltr d-inline-block"
                    >
                    </b-form-input>
                    <b-form-input
                        disabled
                        v-model="form.phone_country_code"
                        class="input-phone-code input-light-silver border-0 text-center dir-ltr d-inline-block"
                    ></b-form-input>
                    <p class="m-2 text-danger">{{ form.error("phone") }}</p>
                </b-form-group>
            </b-form>
        </b-col>
    </b-row>
</template>

<script>
import ConfirmModal from "../Forms/ConfirmPhoneModal";
import Axios from "axios";

export default {
    components: {
        ConfirmModal
    },

    data() {
        return {
            isLoading: false,
            focusOnPhone: false,
            form: this.$inertia.form(
                {
                    phone: "",
                    phone_country_code: "+98"
                },
                {
                    bag: "createUser",
                    resetOnSuccess: false
                }
            )
        };
    },
    methods: {
        onSubmit(e) {
            e.preventDefault();
            this.isLoading = true;

            // let result = axios
            //     .post(route("user.auth"), this.form)
            //     .then(response => {
            //         this.isLoading = false;

            //         console.log(this.form);

            //         console.log(response);
            //     })
            //     .catch(err => console.log(err.response));

            let result = this.form
                .post(route("user.auth"), {
                    preserveScroll: true
                })
                .then(response => {
                    this.isLoading = false;

                    if (this.getProp("trigger_auth")) {
                        this.$refs.confirmModal.activateAuth(
                            this.getProp("phone")
                        );
                    }
                })
                .catch(err => console.log(err));
        },
        onReset() {
            this.$refs.confirmModal.deActivateAuth();
            this.form.phone = "";
        }
    }
};
</script>
