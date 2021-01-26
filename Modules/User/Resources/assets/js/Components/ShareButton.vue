<template>
    <div>
        <button :id="propId" class="btn rounded" v-clipboard:copy="shareUrl">
            <b-icon :icon="icon"></b-icon>
        </button>
        <b-tooltip :target="propId" triggers="click blur">
            {{ __("global.copy") }}
        </b-tooltip>
    </div>
</template>

<script>
export default {
    props: {
        shareUrl: {
            type: String
        },
        icon: {
            type: String,
            default: "share"
        },
        propId: {
            type: String
        }
    }
};
</script>
