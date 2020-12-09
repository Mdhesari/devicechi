<template>
    <div class="card-body rtl text-right wizard-step">
        <inertia-link
            v-if="backLink"
            :href="backLink"
            class="btn btn-link text-secondary btn-backlink"
        >
            {{ __("global.back") }} <b-icon icon="arrow-left" class="vertical-middle"></b-icon>
        </inertia-link>
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: ["backLink"]
};
</script>
