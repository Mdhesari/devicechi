<template>
	<section class="normal-ads-section py-5">
		<div class="container">
			<div class="main-title">
				<h2>
					آگهی ها
				</h2>
			</div>
			<div class="row normal-ads">
				<NormalAd
					v-for="ad in ads"
					:key="ad.id"
					:ad="ad"
					:countAds="ads.length"
				></NormalAd>
				<div class="more">
					<a :href="route('user.ad.home')">
						مشاهده بیشتر
						<i class="fa fa-arrow-left" aria-hidden="true"></i>
					</a>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
import NormalAd from './../Ads/NormalAd'

export default {
	props: ['ads'],
	components: {
		NormalAd
	}
}
</script>
