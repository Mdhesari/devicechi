<template>
    <b-list-group-item
        class="list-contacts-item d-flex justify-content-between align-items-center"
    >
        <p class="list-item-content m-0">
            <b-icon
                :icon="renderContactTypeIcon(contact.type)"
                class="vertical-middle"
            ></b-icon>
            <span
                class="content-value"
                :class="{
                    ltr: contact.type.name == 'phone'
                }"
            >
                {{ contact.value }}
            </span>
        </p>

        <b-button
            :disabled="isLoading"
            variant="link"
            class="text-danger btn-del-contact"
            @click="deleteContact"
        >
            <b-icon icon="x-circle" class="vertical-middle"></b-icon>
        </b-button>
    </b-list-group-item>
</template>

<script>
import ContactTypeMixin from "../Mixins/ContactTypeMixin";

export default {
    props: ["contact", "isLoading"],
    mixins: [ContactTypeMixin],
    methods: {
        deleteContact() {
            this.$emit("deleteContact");
        }
    }
};
</script>
