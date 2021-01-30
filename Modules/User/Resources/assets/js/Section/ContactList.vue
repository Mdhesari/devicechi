<template>
    <div class="call">
        <button
            @click.prevent="loadContacts"
            :disabled="contacts.length > 0"
            class="btn call-btn"
        >
            تماس با آگهی دهنده
        </button>
        <ul class="list-group contacts mt-4">
            <li
                class="list-group-item border-0"
                v-for="contact in contacts"
                :key="contact.id"
            >
                <p class="list-item-content">
                    <b-icon
                        :icon="renderContactTypeIcon(contact.type)"
                        class="vertical-middle"
                        scale="1.4"
                    ></b-icon>

                    <a
                        :href="
                            `${contact.type.data.href || 'tel'}:${
                                contact.value
                            }`
                        "
                        class="content-value d-inline-block ltr mx-4"
                    >
                        {{ contact.value }}
                    </a>

                    <ShareButton
                        class="d-inline-block"
                        icon="clipboard"
                        propId="copy-to-clipboard"
                        :shareUrl="contact.value"
                    ></ShareButton>
                </p>
            </li>
        </ul>
        <PoliceAlert v-show="contacts.length > 0"></PoliceAlert>
    </div>
</template>

<script>
import ContactTypeMixin from "../Mixins/ContactTypeMixin";
import PoliceAlert from "../Section/PoliceAlert";
import ShareButton from "../Components/ShareButton";

export default {
    props: ["ad"],
    mixins: [ContactTypeMixin],
    components: {
        PoliceAlert: PoliceAlert,
        ShareButton: ShareButton
    },
    data() {
        return {
            contacts: []
        };
    },
    methods: {
        loadContacts() {
            axios
                .get(
                    route("user.api.ad.contacts.get", {
                        ad: this.ad.slug
                    })
                )
                .then(response => {
                    if (response.data?.contacts) {
                        this.contacts = response.data.contacts;
                    }
                });
        }
    }
};
</script>
