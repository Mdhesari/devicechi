<template>
    <div class="gallery">
        <div class="swiper-container main-gallery" id="mainHomeSlider">
            <SwiperWrapper>
                <SwiperSlide
                    v-for="(picture, index) in pictures"
                    :key="index"
                    :picture="picture"
                ></SwiperSlide>
            </SwiperWrapper>
        </div>
        <div class="swiper-container gallery-thumbs" id="galleryThumbs">
            <SwiperWrapper>
                <SwiperSlide
                    v-for="(picture, index) in pictures"
                    :key="index"
                    :picture="picture"
                    class="swiper-slide main-gallery-bg height100"
                ></SwiperSlide>
            </SwiperWrapper>
        </div>
    </div>
</template>

<script>
import SwiperWrapper from "./Swiper/SwiperWrapper";
import SwiperSlide from "./Swiper/SwiperSlide";

export default {
    props: ["pictures"],
    components: {
        SwiperWrapper,
        SwiperSlide
    },
    mounted() {
        if (typeof Swiper !== "undefined") {
            var galleryThumbs = new Swiper("#galleryThumbs", {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true
            });
            var galleryTop = new Swiper("#mainHomeSlider", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                thumbs: {
                    swiper: galleryThumbs
                }
            });
        }
    }
};
</script>
