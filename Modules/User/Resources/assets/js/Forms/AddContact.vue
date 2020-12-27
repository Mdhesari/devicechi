<template>
    <div>
        <b-form-group class="mt-2">
            <b-form-group
                v-if="input_data.type && ad_contact === null"
                :label="input_data.type.description"
            >
                <b-form-input
                    @keydown.enter="addContact"
                    @keydown.esc="HideContactInput"
                    required
                    :placeholder="input_data.type.data.placeholder"
                    :type="
                        input_data.type.data.input
                            ? input_data.type.data.input
                            : 'text'
                    "
                    v-model="input_data.value"
                ></b-form-input>
            </b-form-group>
            <!-- Verification form -->
            <b-form-group
                v-if="ad_contact"
                :label="__('ads.form.label.contact.verify')"
            >
                <b-form-input
                    @keydown.enter="verifyContact"
                    required
                    :placeholder="__('ads.form.placeholder.contact.verify')"
                    type="text"
                    v-model="input_data.verify_value"
                ></b-form-input>
            </b-form-group>

            <b-button-group v-if="input_data.type">
                <b-button pill @click="addContact" variant="primary">
                    {{ save_btn_text }}
                </b-button>
                <b-button
                    @click="HideContactInput"
                    variant="link"
                    class="text-danger"
                >
                    <b-icon
                        icon="x-circle-fill"
                        class="vertical-middle"
                    ></b-icon>
                </b-button>
            </b-button-group>
        </b-form-group>

        <b-dropdown
            size="lg"
            no-caret
            variant="link"
            class="btn-add-contact"
            v-if="input_data.type === null"
        >
            <template #button-content>
                <b-icon icon="plus-square-fill"></b-icon>
            </template>
            <b-dropdown-item
                v-for="(contact_type, index) in contactTypes"
                :key="index"
                class="dropdown-contact-item"
                @click="showContactInput(contact_type)"
            >
                <b-icon
                    :icon="renderContactTypeIcon(contact_type)"
                    class="vertical-middle"
                ></b-icon>
                {{ contact_type.description }}
            </b-dropdown-item>
        </b-dropdown>
    </div>
</template>

<script>
import ContactTypeMixin from "../Mixins/ContactTypeMixin.js";

export default {
    props: ["contactTypes"],
    data() {
        return {
            input_data: {
                value: "",
                verify_value: "",
                type: null
            },
            ad_contact: null,
            isLoading: false,
            save_btn_text: this.__("global.save"),
            ad: this.getProp("ad")
        };
    },
    mixins: [ContactTypeMixin],
    methods: {
        verifyContact() {
            axios
                .post(
                    route("user.ad.step_phone_contact.verify", {
                        ad: this.ad.id
                    }),
                    {
                        _method: "put",
                        ad_contact_id: this.ad_contact.id,
                        verification_code: this.input_data.verify_value
                    }
                )
                .then(response => {
                    if (response.data.status) {
                        this.$to(
                            this.__("ads.form.success.contact.add.title"),
                            "",
                            "s"
                        );
                        this.$emit("addContact", response.data.contact);
                        this.HideContactInput();
                    } else {
                        if (response.data.error) {
                            const error = response.data.error;

                            this.$to(error);
                        }
                    }
                })
                .catch(error => {
                    if (error.response.data.errors) {
                        const errors = error.response.data.errors;

                        errors.verification_code.forEach(error => {
                            this.$to(error);
                        });
                    }
                });
        },
        addContact(ev) {
            // in order to prevent event bubbling...
            ev.preventDefault();
            ev.stopPropagation();

            if (this.ad_contact) {
                return this.verifyContact();
            }

            this.isLoading = true;

            if (this.input_data.value.length < 1) {
                this.$to(this.__("ads.form.error.contact.value.title"));
                return 0;
            }

            axios
                .post(
                    route("user.ad.step_phone_contact.add", {
                        ad: this.ad.id
                    }),
                    {
                        contact_type: this.input_data.type,
                        value: this.input_data.value
                    }
                )
                .then(response => {
                    console.log(response);

                    if (response.data.errors) {
                        let errors = response.data.errors;

                        this.$to(errors.error);
                    }

                    if (response.data.status) {
                        this.$to(
                            this.__("ads.form.success.contact.verify.title"),
                            this.__("ads.form.success.contact.verify.desc"),
                            "s"
                        );
                        this.save_btn_text = this.__("global.confirm");
                        this.ad_contact = response.data.contact;
                    }
                })
                .catch(error => {
                    console.log(error);

                    if (error.response.data.errors) {
                        const errors = error.response.data.errors;

                        console.log(errors);

                        if (errors.value)
                            errors.value.forEach(val => {
                                this.$to(val);
                            });
                        else
                            errors.forEach(val => {
                                val.forEach(err => {
                                    this.$to(err);
                                });
                            });
                    }
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        HideContactInput() {
            this.input_data = {
                value: "",
                verify_value: "",
                type: null
            };
            this.ad_contact = null;
        },
        showContactInput(contact_type) {
            this.input_data.value = "";
            this.input_data.type = contact_type;
        }
    }
};
</script>
