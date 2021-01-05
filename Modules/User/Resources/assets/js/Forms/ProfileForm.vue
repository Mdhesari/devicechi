<template>
    <div class="wizard-step">
        <b-form @submit="onSubmit">
            <b-form-group :label="__('profile.form.name')" label-for="name">
                <b-form-input
                    id="name"
                    v-model="form.name"
                    type="text"
                    :placeholder="__('profile.placeholder.name')"
                    required
                ></b-form-input>
                <div class="errors">
                    <p class="text-danger">{{ form.error("name") }}</p>
                </div>
            </b-form-group>

            <b-form-group :label="__('profile.form.phone')" label-for="phone">
                <b-form-input
                    type="number"
                    id="phone"
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
                :label="__('ads.form.label.location.city')"
                label-for="city"
            >
                <b-form-select
                    id="city"
                    v-model="form.city_id"
                    :options="cities"
                ></b-form-select>
            </b-form-group>

            <b-form-group
                :label="__('profile.form.password')"
                label-for="password"
            >
                <b-form-input
                    id="password"
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
                :label="__('profile.form.password_confirmation')"
                label-for="password_confirmation"
            >
                <b-form-input
                    id="password_confirmation"
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
            form: this.$inertia.form({
                _method: "PUT",
                name: this.user.name,
                phone: this.user.phone,
                phone_country_code: this.user.phone_country_code,
                email: this.user.email,
                password: "",
                password_confirmation: "",
                profile: this.user.profile_photo_path,
                city_id: this.user.city?.id || null
            }),
            isLoading: false,
            allCities: this.getProp("cities")
        };
    },
    computed: {
        cities() {
            let _cities = [
                {
                    value: null,
                    text: this.__("ads.form.placeholder.location.city")
                }
            ];

            this.allCities.forEach(city => {
                _cities.push({
                    value: city.id,
                    text: city.name
                });
            });

            return _cities;
        }
    },
    methods: {
        onSubmit(event) {
            event.preventDefault();

            this.form
                .post(route("user.profile.update"), {
                    preserveScroll: true,
                    preserveState: false
                })
                .then(respone => {
                    if (this.$page.flash.toSuccess) {
                        let res = this.$to(
                            "اطلاعات حساب کاربری با موفقیت بروزرسانی شد.",
                            "",
                            "s"
                        );
                    }
                });
        }
    }
};
</script>
