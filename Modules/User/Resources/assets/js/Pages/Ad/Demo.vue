<template>
	<authLayout :user="user">
		<section class="demo">
			<b-container>
				<div class="mt-4">
					<div class="alert" :class="__(`ads.demo.${ad.status}.bg`)">
						<h4 class="alert-heading">
							{{ __(`ads.demo.${ad.status}.title`) }}
						</h4>
						<p>
							{{ __(`ads.demo.${ad.status}.desc`) }}
						</p>
					</div>

					<div class="alert alert-light" v-if="help.length > 1">
						<h4 class="alert-heading">
							پشتیبانی :‌
						</h4>
						{{ help }}
					</div>
				</div>
				<inertia-link
					:href="
						route('user.ad.step_phone_promote', {
							ad
						})
					"
					class="btn btn-lg btn-attract"
				>
					<b-icon icon="lightning"></b-icon>
					ارتقا آگهی
				</inertia-link>
				<SingleAd :ad="ad"></SingleAd>
				<AdActionsGroup :ad="ad" :isConfirmed="ad.is_confirmed" />
			</b-container>
		</section>
	</authLayout>
</template>

<script>
import AuthLayout from '../../Layouts/FrontAuthLayout'
import SingleAd from '../../Components/SingleAd'
import AdActionsGroup from '../../Components/AdActionsGroup'

export default {
	components: {
		AuthLayout,
		SingleAd,
		AdActionsGroup
	},
	props: ['ad', 'user', 'help']
}
</script>
