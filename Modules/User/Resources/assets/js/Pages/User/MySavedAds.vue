<template>
	<AuthLayout :user="user">
		<Panel :user="user" :tabs="tabs">
			<div class="row normal-ads" v-if="ads && !isLoading">
				<NormalAd
					v-for="ad in ads.data"
					:key="ad.id"
					:ad="ad"
					:countAds="ads.data.length"
					:useFour="true"
				></NormalAd>

				<!-- <div class="col-md-6"></div> -->
			</div>

			<Pagination
				size="default"
				align="center"
				:data="ads"
				@pagination-change-page="getResults"
			></Pagination>

			<!-- No Content -->
			<b-alert
				v-if="!isLoading"
				:show="ads.data.length < 1"
				variant="info"
				class="text-center mt-4"
			>
				هیچ آگهی موجود نیست!
			</b-alert>
		</Panel>
	</AuthLayout>
</template>

<script>
import AuthLayout from '../../Layouts/FrontAuthLayout'
import spinner from '../../Components/Spinner'
import Panel from '../../Section/Dashboard/Panel'
import AdPictureHelpers from '../../Mixins/AdPictureHelpers.js'
import NormalAd from '../../Components/Ads/NormalAd'
import Pagination from 'laravel-vue-pagination'

export default {
	components: {
		spinner,
		Panel,
		AuthLayout,
		NormalAd,
		Pagination
	},
	props: ['user', 'tabs'],
	mixins: [AdPictureHelpers],
	data() {
		return {
			ads: this.getProp('ads'),
			activeItem: null,
			isLoading: false
		}
	},
	methods: {
		renderStatusLabel(status) {
			return this.__(`ads.status.${status}.label`)
		},
		renderStatusClass(status) {
			return this.__(`ads.status.${status}.class`)
		},
		renderTitle(title) {
			return title !== null && title.length > 0
				? title
				: this.__('ads.defaults.title')
		},
		getResults(page = 1) {
			axios
				.get(
					route('user.ad.get', {
						page
					})
				)
				.then((response) => {
					this.ads = response.data
				})
		}
	}
}
</script>
