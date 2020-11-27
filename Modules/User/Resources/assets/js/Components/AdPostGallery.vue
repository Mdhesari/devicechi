<template>
    <div class="col-12 col-lg-6 gallery-post links">
        <div class="swiper-container " id="mainHomeSlider">
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

        <div class="short-links">
            <div class="lable">
                <strong>لینک کوتاه</strong>
            </div>
            <span class="short-link">
                https://mobileforsale.com
                <button class="clip-board">
                    <i class="fa fa-clone" aria-hidden="true"></i>
                </button>
            </span>
        </div>
        <div class="actions">
            <div class="call">
                <a href="tel:09190790979" class=" btn call-btn"
                    >تماس با آگهی دهنده</a
                >
            </div>
            <div class="safe">
                راهنمای معاله امن
            </div>
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
