<template>
    <div class="wizard-step">
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
            </b-form-group>

            <b-form-group
                id="input-group-2"
                :label="__('profile.form.email')"
                label-for="input-2"
            >
                <b-form-input
                    id="input-2"
                    v-model="form.email"
                    :placeholder="__('profile.placeholder.email')"
                    required
                ></b-form-input>
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
                    required
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
            form: this.$inertia.form({
                name: this.user.name,
                phone: this.user.phone,
                phone_country_code: this.user.phone_country_code,
                email: this.user.email,
                password: "",
                profile: null
            }),
            isLoading: false
        };
    },
    methods: {
        onSubmit(event) {
            event.preventDefault();
            alert(JSON.stringify(this.form));

            this.form.post(route(""))
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
