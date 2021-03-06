<template>
	<section class="brand-section py-5">
		<div class="container">
			<div class="main-title">
				<a href="#">
					<h2>
						برند ها
					</h2>
				</a>
			</div>
			<div class="row brands">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div
							class="swiper-slide"
							v-for="(brand, index) in brands"
							:key="index"
						>
							<div class="inner-slider">
								<a href="#">
									<img :src="brand.picture_url" alt="" />
								</a>
							</div>
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
export default {
	props: ['brands'],
	mounted() {
		if (typeof Swiper !== 'undefined') {
			var swiper = new Swiper('.swiper-container', {
				slidesPerView: 5,
				spaceBetween: 10,
				// centeredSlides: true,
				pagination: {
					el: '.swiper-pagination',
					clickable: true
				},
				breakpoints: {
					// when window width is <= 768px
					992: {
						slidesPerView: 5,
						spaceBetweenSlides: 10
					},
					768: {
						slidesPerView: 3,
						spaceBetweenSlides: 30
					},
					100: {
						slidesPerView: 2,
						spaceBetweenSlides: 50
					}
					// when window width is <= 999px
				},
				autoplay: {
					delay: 2500,
					disableOnInteraction: false
				}
			})
		}
	}
}
</script>
