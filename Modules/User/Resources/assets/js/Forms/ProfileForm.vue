<template>
    <div class="wizard-step">
        <b-alert ref="alert" variant="success" :show="showAlert">
            با موفقیت بروزرسانی شد...
        </b-alert>
        <b-form @submit="onSubmit" @reset="onReset">
            <b-form-group
                id="input-group-1"
                :label="__('profile.form.name')"
                label-for="input-1"
            >
                <b-form-input
                    id="input-1"
                    v-model="form.name"
                    type="text"
                    :placeholder="__('profile.placeholder.name')"
                    required
                ></b-form-input>
                <div class="errors">
                    <p class="text-danger">{{ form.error("name") }}</p>
                </div>
            </b-form-group>

            <b-form-group
                id="input-group-2"
                :label="__('profile.form.phone')"
                label-for="input-2"
            >
                <b-form-input
                    id="input-2"
                    v-model="form.phone"
                    :placeholder="__('profile.placeholder.phone')"
                    required
                ></b-form-input>

                <p
                    class="help text-muted"
                    v-text="__('profile.help.phone')"
                ></p>

                <div class="errors">
                    <p class="text-danger">{{ form.error("phone") }}</p>
                </div>
            </b-form-group>

            <b-form-group
                id="input-group-2"
                :label="__('profile.form.password')"
                label-for="input-2"
            >
                <b-form-input
                    id="input-2"
                    v-model="form.password"
                    :placeholder="__('profile.placeholder.password')"
                ></b-form-input>

                <p
                    class="help text-muted"
                    v-text="__('profile.help.password')"
                ></p>

                <div class="errors">
                    <p class="text-danger">{{ form.error("password") }}</p>
                </div>
            </b-form-group>

            <b-form-group
                id="input-group-2"
                :label="__('profile.form.password_confirmation')"
                label-for="input-2"
            >
                <b-form-input
                    id="input-2"
                    v-model="form.password_confirmation"
                    :placeholder="
                        __('profile.placeholder.password_confirmation')
                    "
                ></b-form-input>
            </b-form-group>

            <b-button type="submit" variant="primary">
                {{ __("global.save") }}
            </b-button>
        </b-form>
    </div>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            form: null,
            isLoading: false,
            showAlert: false
        };
    },
    mounted() {
        this.setupForm();
    },
    methods: {
        setupForm() {
            this.form = this.$inertia.form({
                _method: "PUT",
                name: this.user.name,
                phone: this.user.phone,
                phone_country_code: this.user.phone_country_code,
                email: this.user.email,
                password: "",
                password_confirmation: "",
                profile: null
            });
        },
        onSubmit(event) {
            event.preventDefault();

            this.form
                .post(route("user.profile.update"), {
                    preserveScroll: true,
                    preserveState: true
                })
                .then(respone => {
                    if (this.form.successful) {
                        this.$to(
                            "اطلاعات حساب کاربری با موفقیت بروزرسانی شد.",
                            "",
                            "s"
                        );
                        this.setupForm();
                    }
                });
        },
        onReset(event) {
            event.preventDefault();
            // Reset our form values
            this.form.email = "";
            this.form.name = "";
            this.form.food = null;
            this.form.checked = [];
            // Trick to reset/clear native browser form validation state
            this.show = false;
            this.$nextTick(() => {
                this.show = true;
            });
        }
    }
};
</script>
