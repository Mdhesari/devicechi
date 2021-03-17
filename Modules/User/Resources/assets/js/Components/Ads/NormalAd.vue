<template>
	<div
		class="normal-ad col-12 col-sm-6 col-md-3"
	>
		<inertia-link
			:href="
				route('user.ad.show', {
					ad: ad.slug
				})
			"
		>
			<div class="inner">
				<div class="thumbnail">
					<img :src="renderAdPicture(ad, 'thumb_url')" :alt="ad.title" />
					<!-- <SaveButton :user="user" :ad="ad"></SaveButton> -->
				</div>
				<div class="details">
					<h3 class="ad-name">
						{{ ad.title }}
					</h3>
					<div class="ad-price text-muted mt-4 mb-3">
						<strong>
							<span>{{ formatMoney(ad.price) }}</span>
							<span>تومان</span>
						</strong>
					</div>
					<p class="publish-time text-muted" v-if="ad.state">
						<span>
							{{ moment(ad.created_at).fromNow() }}
						</span>
						<span>در</span>
						<span v-text="ad.state.city.name"></span>
						<span>,</span>
						<span v-text="ad.state.name"></span>
					</p>
					<slot></slot>
				</div>
			</div>
		</inertia-link>
	</div>
</template>

<script>
import AdPictureHelpers from './../../Mixins/AdPictureHelpers.js'
import SaveButton from '../SaveButton'

export default {
	components: {
		SaveButton
	},
	props: {
		useFour: {
			type: Boolean,
			default: true
		},
		ad: {
			type: Object
		},
		countAds: {
			type: Number
		}
	},
	mixins: [AdPictureHelpers],
	data() {
		return {
			user: this.getProp('user')
		}
	}
}
</script>
