<template>
    <WizardStep :backLink="route('user.ad.step_phone_contact')">
        <form @keyup.enter.stop.prevent @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_contact.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_contact.desc") }}
            </p>

            <b-list-group class="list-contacts">
                <ContactListItem
                    v-for="(contact, index) in contacts"
                    :key="index"
                    :contact="contact"
                />
            </b-list-group>

            <b-form-group class="mt-2">
                <b-form-group
                    v-if="input_data.type"
                    :label="input_data.type.description"
                >
                    <b-form-input
                        @keyup.enter="addContact"
                        @keydown.esc="HideContactInput"
                        :placeholder="input_data.type.data.placeholder"
                        :type="
                            input_data.type.data.input
                                ? input_data.type.data.input
                                : 'text'
                        "
                        v-model="input_data.value"
                    ></b-form-input>
                </b-form-group>
            </b-form-group>

            <b-dropdown
                size="lg"
                no-caret
                variant="link"
                class="btn-add-contact"
            >
                <template #button-content>
                    <b-icon icon="plus-square-fill"></b-icon>
                </template>
                <b-dropdown-item
                    v-for="(contact_type, index) in contact_types"
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

            <b-button
                v-if="contacts.length > 0"
                variant="secondary"
                @click.prevent="next"
                :disabled="isInvalid"
            >
                {{ __("global.next") }}
            </b-button>
        </form>
    </WizardStep>
</template>

<script>
import WizardStep from "../../../Components/WizardStep";
import ContactListItem from "../../../Components/ContactListItem";
import ContactTypeMixin from "../../../Mixins/ContactTypeMixin.js";

export default {
    components: {
        WizardStep,
        ContactListItem
    },
    data() {
        return {
            contacts: this.getProp("contacts"),
            contact_types: this.getProp("contact_types"),
            input_data: {
                value: "",
                type: null
            },
            isInvalid: false,
            isLoading: false
        };
    },
    mixins: [ContactTypeMixin],
    methods: {
        next(ev) {
            if (this.isLoading && this.input_data.type !== null) return 0;

            this.$inertia.post(route("user.ad.step_phone_contact"), {
                contacts: this.contacts
            });
        },
        addContact(ev) {
            // in order to prevent event bubbling...
            ev.preventDefault();
            ev.stopPropagation();
            this.isLoading = true;

            axios
                .post(route("user.ad.step_phone_contact.add"), {
                    contact_type: this.input_data.type,
                    value: this.input_data.value
                })
                .then(response => {
                    if (response.data.status) {
                        this.$to(
                            this.__("ads.form.success.contact.add.title"),
                            "",
                            "s"
                        );
                        this.contacts.push(response.data.contact);
                    }
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        showContactInput(contact_type) {
            this.input_data.value = "";
            this.input_data.type = contact_type;
        },
        HideContactInput() {
            this.input_data = {
                value: "",
                type: null
            };
        }
    }
};
</script>
