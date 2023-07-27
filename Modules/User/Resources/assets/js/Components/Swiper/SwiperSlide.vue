<template>
    <div
        class="swiper-slide main-gallery-bg main-img"
        :style="{
            'background-image': `url(${picture.url})`
        }"
    >
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: ["picture"]
};
</script>
