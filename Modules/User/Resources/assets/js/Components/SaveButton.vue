<template>
    <button
        v-b-tooltip.click
        :title="getTooltip"
        class="btn rounded"
        @click="save"
    >
        <b-icon :icon="isSaved ? 'bookmark-check-fill' : 'bookmark'"></b-icon>
    </button>
</template>

<script>
export default {
    props: ["ad"],
    data() {
        return {
            isSaved: Boolean(this.getProp("is_bookmarked_for_user"))
        };
    },
    methods: {
        getTooltip() {
            return this.isSaved
                ? this.__("global.unbookmark")
                : this.__("global.bookmark");
        },
        async save() {
            const response = await axios.post(route("user.ad.bookmark"), {
                ad: this.ad.id,
                attach: !this.isSaved
            });

            if (response.status == 200) {
                this.isSaved = !this.isSaved;
            }
        }
    }
};
</script>
