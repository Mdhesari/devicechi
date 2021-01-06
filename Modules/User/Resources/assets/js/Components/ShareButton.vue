<template>
    <div>
        <button
            id="copy-share-link"
            class="btn rounded"
            v-clipboard:copy="shareUrl"
        >
            <b-icon icon="share"></b-icon>
        </button>
        <b-tooltip target="copy-share-link" triggers="click blur">
            {{ __("global.copy") }}
        </b-tooltip>
    </div>
</template>

<script>
export default {
    props: ["shareUrl"]
};
</script>
