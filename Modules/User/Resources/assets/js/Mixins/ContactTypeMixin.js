export default {
    methods: {
        renderContactTypeIcon(contact_type) {
            if (contact_type.data) {
                if (contact_type.data.icon) return contact_type.data.icon;
            }

            return contact_type.name;
        }
    }
};
