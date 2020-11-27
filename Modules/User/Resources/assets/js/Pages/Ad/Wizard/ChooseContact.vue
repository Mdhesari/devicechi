<template>
    <WizardStep :backLink="route('user.ad.step_phone_location')">
        <form @submit.prevent="next">
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
                    :isLoading="isLoading"
                    @deleteContact="deleteContact(contact)"
                />
            </b-list-group>

            <AddContactForm
                @addContact="addContact"
                :contactTypes="contact_types"
            />

            <b-button
                v-if="contacts.length > 0"
                variant="secondary"
                @click.prevent="next"
                :disabled="isLoading"
            >
                {{ __("global.next") }}
            </b-button>
        </form>
    </WizardStep>
</template>

<script>
import WizardStep from "../../../Components/WizardStep";
import ContactListItem from "../../../Components/ContactListItem";
import AddContactForm from "../../../Forms/AddContact";

export default {
    components: {
        WizardStep,
        ContactListItem,
        AddContactForm
    },
    data() {
        return {
            contacts: this.getProp("contacts"),
            contact_types: this.getProp("contact_types"),
            input_data: {
                value: "",
                type: null
            },
            isLoading: false
        };
    },
    methods: {
        next(ev) {
            const keyCode = event.which || event.keyCode || 0;

            if (keyCode != 1) return false;

            this.$inertia
                .post(route("user.ad.step_phone_contact"), {
                    contacts: this.contacts
                })
                .then(response => {
                    if (this.error("contacts")) {
                        this.$to(this.error("contacts"));
                    }
                });
        },
        addContact(contact) {
            this.contacts.push(contact);
        },
        deleteContact(contact) {
            if (this.contacts.length < 2) {
                this.$to(
                    this.__("ads.form.error.contact.limitDelete.title"),
                    this.__("ads.form.error.contact.limitDelete.desc")
                );
                return 0;
            }

            this.isLoading = true;
            axios
                .post(route("user.ad.step_phone_contact.delete"), {
                    _method: "delete",
                    contact_id: contact.id
                })
                .then(response => {
                    if (response.data.status) {
                        this.$to(
                            this.__("ads.form.success.contact.delete.title"),
                            this.__("ads.form.success.contact.delete.desc"),
                            "s"
                        );
                        this.contacts = response.data.contacts;
                    }
                })
                .catch(error => {
                    const errors = error.response.data.errors;

                    console.log(error.response.data);
                    if (errors)
                        errors.value.forEach(val => {
                            this.$to(val);
                        });
                })
                .finally(() => {
                    this.isLoading = false;
                });
        }
    }
};
</script>
