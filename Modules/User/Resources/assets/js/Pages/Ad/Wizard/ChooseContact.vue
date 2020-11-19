<template>
    <WizardStep :backLink="route('user.ad.step_phone_contact')">
        <form @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.choose_contact.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.choose_contact.desc") }}
            </p>

            <b-list-group class="list-contacts">
                <b-list-group-item
                    v-for="(contact, index) in contacts"
                    :key="index"
                    class="d-flex justify-content-between align-items-center"
                >
                    <p class="list-item-content m-0">
                        <b-icon
                            :icon="renderContactTypeIcon(contact.type)"
                            class="vertical-middle"
                        ></b-icon>
                        <span class="content-value">
                            {{ contact.value }}
                        </span>
                    </p>

                    <b-button variant="link" class="text-danger">
                        <b-icon
                            icon="x-circle"
                            class="vertical-middle"
                        ></b-icon>
                    </b-button>
                </b-list-group-item>
            </b-list-group>

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
                >
                    <b-icon
                        :icon="renderContactTypeIcon(contact_type)"
                        class="vertical-middle"
                    ></b-icon>
                    {{ contact_type.description }}
                </b-dropdown-item>
            </b-dropdown>
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
            contacts: this.getProp("contacts"),
            contact_types: this.getProp("contact_types")
        };
    },
    methods: {
        next(variant_id) {
            // this.$emit("next");
        },
        renderContactTypeIcon(contact_type) {
            if (contact_type.data) {
                if (contact_type.data.icon) return contact_type.data.icon;
            }

            return contact_type.name;
        }
    }
};
</script>
