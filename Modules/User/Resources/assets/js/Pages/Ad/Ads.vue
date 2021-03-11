<template>
	<authLayout :user="user">
		<section class="page-title-container mb-4">
			<div class="container">
				<h1 class="page-title">آگهی ها فروش گوشی</h1>
				<!-- <p
                    class="text-lead mt-4"
                    v-if="search && search.length > 0"
                    v-text="`جستجو برای '${search}'`"
                ></p> -->
			</div>
		</section>

		<SearchSection :searchURL="searchURL" :search="search" />

		<section class="normal-adssection mt-4">
			<div class="container">
				<div class="main-title">
					<h3>
						{{ __('ads.latest') }}
					</h3>
				</div>

				<!-- No Content -->
				<b-alert
					:show="allAds.data.length < 1"
					variant="info"
					class="text-center mt-4"
				>
					{{
						__('ads.not-found', {
							q: search || cityName
						})
					}}

					<a
						:href="
							route('user.ad.home', {
								city: cityName
							})
						"
						class="btn btn-link"
					>
						{{ __('ads.reload') }}
					</a>
				</b-alert>

				<div v-if="allAds.data.length > 0" class="row normal-ads">
					<NormalAd
						v-for="ad in allAds.data"
						:key="ad.id"
						:ad="ad"
						:countAds="allAds.data.length"
					></NormalAd>
				</div>

				<Pagination
					size="default"
					align="center"
					:data="allAds"
					@pagination-change-page="getResults"
				></Pagination>
			</div>
		</section>
	</authLayout>
</template>

<script>
import AuthLayout from '../../Layouts/FrontAuthLayout'
import NormalAd from '../../Components/Ads/NormalAd'
import SearchSection from '../../Section/Ad/Search'
import FilterSection from '../../Section/Ad/Filter'
import Pagination from 'laravel-vue-pagination'

export default {
	components: {
		AuthLayout,
		NormalAd,
		SearchSection,
		FilterSection,
		Pagination
	},
	data() {
		return {
			allAds: this.getProp('ads'),
			cityName: this.getProp('cityName')
		}
	},
	props: ['ads', 'proAds', 'user', 'search', 'searchURL'],
	methods: {
		getResults(page = 1) {
			axios
				.get(
					route('user.ad.home', {
						page,
						q: this.search
					})
				)
				.then((response) => {
					this.allAds = response.data
				})
		}
	}
}
</script>
